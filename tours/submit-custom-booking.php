<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require '../config/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: signup.php");
    exit;
}

function clean($data)
{
    return htmlspecialchars(trim($data));
}

// Telegram config - set your token and chat ID here
define('TELEGRAM_BOT_TOKEN', '8445182703:AAGTGLpr1MBvq_UjbPD3cf2hrQubmt377mY');
define('TELEGRAM_CHAT_ID', '7187696102');

// Function to send message to Telegram
function sendTelegramMessage($message)
{
    $url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage";
    $post_fields = [
        'chat_id' => TELEGRAM_CHAT_ID,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

// Helper to get name by ID from a table and column
function getNameById($mysqli, $table, $idColumn, $nameColumn, $id)
{
    if ($id <= 0) return "N/A";
    $stmt = $mysqli->prepare("SELECT $nameColumn FROM $table WHERE $idColumn = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($name);
    if ($stmt->fetch()) {
        $stmt->close();
        return $name ?: "N/A";
    }
    $stmt->close();
    return "N/A";
}
// Customer info
$first_name = clean($_POST['first_name'] ?? '');
$last_name = clean($_POST['last_name'] ?? '');
$email = clean($_POST['email'] ?? '');
$phone = clean($_POST['phone'] ?? '');
$additional_phone = clean($_POST['additional_phone'] ?? '');
$address = clean($_POST['address'] ?? '');
$street_no = clean($_POST['street_no'] ?? '');
$city = clean($_POST['city'] ?? '');
$country = clean($_POST['country'] ?? '');
$zip = clean($_POST['zip'] ?? '');
$passport_number = clean($_POST['passport_number'] ?? '');
$fly_number = clean($_POST['fly_number'] ?? '');
$nationality = clean($_POST['nationality'] ?? '');

if (!$first_name || !$last_name || !$email || !$phone || !$address || !$nationality) {
    die("Missing required fields.");
}

$mysqli->begin_transaction();

try {
    // Insert new customer every time (no lookup or update)
    $insertStmt = $mysqli->prepare("
        INSERT INTO customers (
            first_name, last_name, email, phone, additional_phone, address, 
            street_no, city, country, zip, passport_number, fly_number, nationality
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $insertStmt->bind_param(
        "sssssssssssss",
        $first_name,
        $last_name,
        $email,
        $phone,
        $additional_phone,
        $address,
        $street_no,
        $city,
        $country,
        $zip,
        $passport_number,
        $fly_number,
        $nationality
    );
    $insertStmt->execute();
    $customer_id = $insertStmt->insert_id;
    $insertStmt->close();

    if (!$customer_id) {
        throw new Exception("Customer ID not found or failed to insert.");
    }

    // Decode custom tour info JSON
    $customTourInfoJson = $_POST['custom_tour_info_json'] ?? '{}';
    $customTourInfo = json_decode($customTourInfoJson, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("JSON Decode Error: " . json_last_error_msg());
    }

    if (empty($customTourInfo)) {
        throw new Exception("No custom tour info received.");
    }

    // Extract tour data
    $tour_name = clean($customTourInfo['tour_name'] ?? 'Custom Tour');
    $start_date = $customTourInfo['travel_date'] ?? null;
    $duration = intval($customTourInfo['trip_days'] ?? 0);
    $num_adults = intval($customTourInfo['travelers_adults'] ?? 0);
    $num_children = intval($customTourInfo['travelers_children'] ?? 0);
    $hotel_room_amount = intval($customTourInfo['hotel_rooms'] ?? 0);
    $budget_per_person = floatval($customTourInfo['budget_per_person'] ?? 0);
    $destination = isset($customTourInfo['destinations']) ? implode(', ', (array)$customTourInfo['destinations']) : '';

    $tour_type_id = intval($customTourInfo['tour_type_id'] ?? 0);
    $accommodation_type_id = intval($customTourInfo['accommodation_type_id'] ?? 0);

    $special_requests = clean($_POST['special_requests'] ?? '');
    $dietary_restrictions = clean($_POST['dietary'] ?? '');
    $visa_permit = isset($_POST['visa_permit']) && $_POST['visa_permit'] === 'Yes' ? 'Yes' : 'No';
    $add_on = isset($_POST['add_on']) ? implode(', ', (array)$_POST['add_on']) : 'None';

    $pay_method_id = intval($_POST['payment_method'] ?? 0);

    // Flight offer
    $flight_offer = clean($customTourInfo['international_flight'] ?? 'No');

    // Insert custom tour
    $insertTourStmt = $mysqli->prepare("
        INSERT INTO custom_tour (
            user_id, tour_name, start_date, duration, num_adults, num_children,
            hotel_room_amount, budget_per_person, destination, tour_type_id,
            accommodation_type_id, special_requests, dietary_restrictions,
            visa_permit, add_on, pay_method_id, flight_offer
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $insertTourStmt->bind_param(
        "issiiiidsssssssis",
        $customer_id,
        $tour_name,
        $start_date,
        $duration,
        $num_adults,
        $num_children,
        $hotel_room_amount,
        $budget_per_person,
        $destination,
        $tour_type_id,
        $accommodation_type_id,
        $special_requests,
        $dietary_restrictions,
        $visa_permit,
        $add_on,
        $pay_method_id,
        $flight_offer
    );
    $insertTourStmt->execute();
    $custom_tour_id = $insertTourStmt->insert_id;
    $insertTourStmt->close();

    // Generate booking code starting with "JCY"
    $booking_code = 'JCY-C' . date('Ymd') . '-' . strtoupper(substr(md5($custom_tour_id . time()), 0, 4));

    $updateCodeStmt = $mysqli->prepare("UPDATE custom_tour SET booking_code = ? WHERE id = ?");
    $updateCodeStmt->bind_param("si", $booking_code, $custom_tour_id);
    $updateCodeStmt->execute();
    $updateCodeStmt->close();

    $mysqli->commit();

    // Get names from IDs for Telegram
    $tour_type_name = getNameById($mysqli, 'tour_type', 'tour_type_id', 'tour_type', $tour_type_id);
    $accommodation_type_name = getNameById($mysqli, 'accommodation_type', 'accommodation_type_id', 'accommodation_type', $accommodation_type_id);
    $pay_method_name = getNameById($mysqli, 'pay_method', 'id', 'method_name', $pay_method_id);

    // Prepare Telegram message
    $message = "<b>📢 New Custom Tour Booking Received!</b>\n\n" .

        "<b>🆔 Booking Code:</b> <code>$booking_code</code>\n\n" .

        "<b>👤 Customer Information</b>\n" .
        "• <b>Name:</b> $first_name $last_name\n" .
        "• <b>Email:</b> $email\n" .
        "• <b>Phone:</b> $phone\n" .
        "• <b>Additional Phone:</b> " . ($additional_phone ?: 'N/A') . "\n" .
        "• <b>Address:</b> $address" .
        ($street_no ? ", $street_no" : "") .
        ($city ? ", $city" : "") .
        ($country ? ", $country" : "") .
        ($zip ? ", ZIP: $zip" : "") . "\n" .
        "• <b>Passport Number:</b> " . ($passport_number ?: 'N/A') . "\n" .
        "• <b>Fly Number:</b> " . ($fly_number ?: 'N/A') . "\n" .
        "• <b>Nationality:</b> $nationality\n\n" .

        "<b>🗓️ Tour Details</b>\n" .
        "• <b>Tour Name:</b> $tour_name\n" .
        "• <b>Start Date:</b> " . ($start_date ?: 'N/A') . "\n" .
        "• <b>Duration:</b> " . ($duration ?: 'N/A') . " days\n" .
        "• <b>Adults:</b> $num_adults\n" .
        "• <b>Children:</b> $num_children\n" .
        "• <b>Hotel Rooms:</b> $hotel_room_amount\n" .
        "• <b>Budget/Person:</b> $" . number_format($budget_per_person, 2) . "\n" .
        "• <b>Destination(s):</b> " . ($destination ?: 'N/A') . "\n" .
        "• <b>Tour Type:</b> " . ($tour_type_name ?: 'N/A') . "\n" .
        "• <b>Accommodation Type:</b> " . ($accommodation_type_name ?: 'N/A') . "\n\n" .

        "<b>📝 Special Requirements</b>\n" .
        "• <b>Special Requests:</b> " . ($special_requests ?: 'None') . "\n" .
        "• <b>Dietary Restrictions:</b> " . ($dietary_restrictions ?: 'None') . "\n" .
        "• <b>Visa Permit Required:</b> $visa_permit\n" .
        "• <b>Add-Ons:</b> $add_on\n\n" .

        "<b>💳 Payment & Flight</b>\n" .
        "• <b>Payment Method:</b> " . ($pay_method_name ?: 'N/A') . "\n" .
        "• <b>Flight Offer:</b> $flight_offer\n";

    sendTelegramMessage($message);


    // Redirect with success and code (optional)
    header("Location: custom-tour.php?booking=success&code=$booking_code");
    exit;
} catch (Exception $e) {
    $mysqli->rollback();
    die("Booking failed: " . $e->getMessage());
}
