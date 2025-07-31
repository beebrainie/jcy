<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit();
}

// Enable error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Debug: Log all POST data
error_log("POST data: " . print_r($_POST, true));

// Enhanced Telegram notification function with detailed tour information
function sendTelegramNotification($booking_data, $tour_data, $payment_method)
{
    $bot_token = '8445182703:AAGTGLpr1MBvq_UjbPD3cf2hrQubmt377mY'; // Replace with your actual bot token
    $chat_id = '7187696102'; // Replace with your chat ID or channel ID

    // Build comprehensive message
    $message = "🎉 *NEW TOUR BOOKING RECEIVED!*\n";
    $message .= "━━━━━━━━━━━━━━━━━━━━━━\n\n";

    // Booking Information
    $message .= "📋 *BOOKING DETAILS*\n";
    $message .= "• *Booking Code:* `" . $booking_data['booking_code'] . "`\n";
    $message .= "• *Booking ID:* " . $booking_data['booking_id'] . "\n";
    $message .= "• *Status:* Pending\n";
    $message .= "• *Booking Date:* " . date('Y-m-d H:i:s') . "\n\n";

    // Tour Information
    $message .= "🗺️ *TOUR INFORMATION*\n";
    $message .= "• *Tour Name:* " . $tour_data['name'] . "\n";
    $message .= "• *Tour ID:* " . $tour_data['id'] . "\n";
    if (!empty($tour_data['description'])) {
        $message .= "• *Description:* " . substr($tour_data['description'], 0, 100) . (strlen($tour_data['description']) > 100 ? "..." : "") . "\n";
    }
    if (!empty($tour_data['duration'])) {
        $message .= "• *Duration:* " . $tour_data['duration'] . "\n";
    }
    if (!empty($tour_data['location'])) {
        $message .= "• *Location:* " . $tour_data['location'] . "\n";
    }
    if (!empty($tour_data['category'])) {
        $message .= "• *Category:* " . $tour_data['category'] . "\n";
    }
    $message .= "• *Tour Date:* " . $booking_data['tour_date'] . "\n\n";

    // Customer Information
    $message .= "👤 *CUSTOMER DETAILS*\n";
    $message .= "• *Name:* " . $booking_data['customer_name'] . "\n";
    $message .= "• *Email:* " . $booking_data['email'] . "\n";
    $message .= "• *Phone:* " . $booking_data['phone'] . "\n";
    if (!empty($booking_data['additional_phone'])) {
        $message .= "• *Additional Phone:* " . $booking_data['additional_phone'] . "\n";
    }
    $message .= "• *Nationality:* " . $booking_data['nationality'] . "\n";
    if (!empty($booking_data['address'])) {
        $message .= "• *Address:* " . $booking_data['address'] . "\n";
    }
    if (!empty($booking_data['passport_number'])) {
        $message .= "• *Passport:* " . $booking_data['passport_number'] . "\n";
    }
    if (!empty($booking_data['fly_number'])) {
        $message .= "• *Flight Number:* " . $booking_data['fly_number'] . "\n";
    }
    $message .= "\n";

    // Group Information
    $message .= "👥 *GROUP DETAILS*\n";
    $message .= "• *Adults:* " . $booking_data['adults'] . "\n";

    if ($booking_data['child12'] > 0) {
        $message .= "• *Children (12+ years):* " . $booking_data['child12'] . "\n";
    }
    if ($booking_data['child75'] > 0) {
        $message .= "• *Children (5-11 years - 75% price):* " . $booking_data['child75'] . "\n";
    }
    if ($booking_data['child50'] > 0) {
        $message .= "• *Children (5-11 years - 50% price):* " . $booking_data['child50'] . "\n";
    }
    if ($booking_data['child0'] > 0) {
        $message .= "• *Children (Under 5 - Free):* " . $booking_data['child0'] . "\n";
    }

    $total_participants = $booking_data['adults'] + $booking_data['child12'] + $booking_data['child75'] + $booking_data['child50'] + $booking_data['child0'];
    $message .= "• *Total Participants:* " . $total_participants . "\n";

    if (!empty($booking_data['group_size'])) {
        $message .= "• *Group Size Category:* " . $booking_data['group_size'] . "\n";
    }
    $message .= "\n";

    // Pricing Information  
    $message .= "💰 *PRICING DETAILS*\n";
    if (!empty($booking_data['base_price']) && $booking_data['base_price'] > 0) {
        $message .= "• *Base Price:* $" . number_format($booking_data['base_price'], 2) . "\n";
    }
    $message .= "• *Total Price:* $" . number_format($booking_data['total_price'], 2) . "\n";
    $message .= "• *Payment Method:* " . $payment_method . "\n\n";

    // Special Requests
    if (!empty($booking_data['special_request']) || !empty($booking_data['dietary_request'])) {
        $message .= "📝 *SPECIAL REQUESTS*\n";
        if (!empty($booking_data['special_request'])) {
            $message .= "• *Special Request:* " . $booking_data['special_request'] . "\n";
        }
        if (!empty($booking_data['dietary_request'])) {
            $message .= "• *Dietary Requirements:* " . $booking_data['dietary_request'] . "\n";
        }
        $message .= "\n";
    }

    // Action Required
    $message .= "⚡ *ACTION REQUIRED*\n";
    $message .= "• Please review and confirm this booking\n";
    $message .= "• Contact customer if needed\n";
    $message .= "• Update booking status in admin panel\n\n";

    $message .= "━━━━━━━━━━━━━━━━━━━━━━\n";
    $message .= "🕐 *Notification sent at:* " . date('Y-m-d H:i:s T') . "\n";

    $url = "https://api.telegram.org/bot{$bot_token}/sendMessage";

    $data = [
        'chat_id' => $chat_id,
        'text' => $message,
        'parse_mode' => 'Markdown'
    ];

    // Use cURL for better reliability
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $result = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($result === false) {
        error_log("cURL Error: " . curl_error($ch));
    } else {
        error_log("Telegram API Response: " . $result);
    }

    curl_close($ch);

    return $http_code == 200;
}

try {
    // Start transaction
    $mysqli->begin_transaction();

    // Collect form data with better validation
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $additional_phone = trim($_POST['additional_phone'] ?? '') ?: null;
    $address = trim($_POST['address'] ?? '');
    $street_no = trim($_POST['street_no'] ?? '') ?: null;
    $city = trim($_POST['city'] ?? '') ?: null;
    $country = trim($_POST['country'] ?? '') ?: null;
    $zip = trim($_POST['zip'] ?? '') ?: null;
    $passport_number = trim($_POST['passport_number'] ?? '') ?: null;
    $fly_number = trim($_POST['fly_number'] ?? '') ?: null;
    $nationality = trim($_POST['nationality'] ?? '') ?: null;

    // Booking data
    $tour_id = intval($_POST['tour_id'] ?? 0);
    $tour_date = $_POST['tour_date'] ?? '';
    $adults = intval($_POST['adults'] ?? 1);
    $child12 = intval($_POST['child12'] ?? 0);
    $child75 = intval($_POST['child75'] ?? 0);
    $child50 = intval($_POST['child50'] ?? 0);
    $child0 = intval($_POST['child0'] ?? 0);
    $base_price = floatval($_POST['base_price'] ?? 0);
    $total_price = floatval($_POST['total_price'] ?? 0);
    $payment_method_id = intval($_POST['payment_method'] ?? 0);
    $dietary_request = trim($_POST['dietary'] ?? '') ?: null;
    $special_request = trim($_POST['special_requests'] ?? '') ?: null;
    $group_size = $_POST['group_size'] ?? '';

    // Debug: Check what we got
    error_log("Parsed data - first_name: '$first_name', last_name: '$last_name', email: '$email', phone: '$phone', address: '$address', nationality: '$nationality', tour_id: $tour_id, tour_date: '$tour_date'");

    // Detailed validation with specific error messages
    $missing_fields = [];

    if (empty($first_name)) $missing_fields[] = 'first_name';
    if (empty($last_name)) $missing_fields[] = 'last_name';
    if (empty($email)) $missing_fields[] = 'email';
    if (empty($phone)) $missing_fields[] = 'phone';
    if (empty($address)) $missing_fields[] = 'address';
    if (empty($nationality)) $missing_fields[] = 'nationality';
    if ($tour_id <= 0) $missing_fields[] = 'tour_id';
    if (empty($tour_date)) $missing_fields[] = 'tour_date';

    if (!empty($missing_fields)) {
        throw new Exception('Missing required fields: ' . implode(', ', $missing_fields));
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format');
    }

    // Validate tour_date format (assuming YYYY-MM-DD)
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tour_date)) {
        throw new Exception('Invalid tour date format. Expected YYYY-MM-DD, got: ' . $tour_date);
    }

    // Fetch tour information for Telegram notification
    // First try to get basic info from package_tour table, then look for detailed info
    $tour_data = null;

    try {
        // Try to get tour info from package_tour table first
        $stmt = $mysqli->prepare("SELECT * FROM package_tours WHERE id = ? LIMIT 1");

        $stmt->bind_param("i", $tour_id);
        $stmt->execute();
        $tour_result = $stmt->get_result();

        if ($tour_result->num_rows > 0) {
            $package_data = $tour_result->fetch_assoc();
            error_log("Found package data: " . print_r($package_data, true));
            $tour_data = [
                'id' => $tour_id,
                'name' => $package_data['tour_name'] ?? 'Tour #' . $tour_id,
                'description' => $package_data['description'] ?? 'Tour details not available',
                'duration' => $package_data['durations'] ?? 'N/A',
                'location' => $package_data['destinations'] ?? 'N/A',
                'category' => 'N/A', // no category in this table
                'base_price' => $package_data['price_start'] ?? $base_price,
                'includes' => null,
                'excludes' => null,
                'itinerary' => null
            ];
        } else {
            // If not found in package_tour, try other common table names
            $tour_tables_to_try = ['tours', 'tour', 'tour_packages', 'packages', 'destinations'];

            foreach ($tour_tables_to_try as $table_name) {
                try {
                    $stmt = $mysqli->prepare("SELECT * FROM `$table_name` WHERE id = ? LIMIT 1");
                    $stmt->bind_param("i", $tour_id);
                    $stmt->execute();
                    $tour_result = $stmt->get_result();

                    if ($tour_result->num_rows > 0) {
                        $tour_data_raw = $tour_result->fetch_assoc();
                        error_log("Found tour data in table '$table_name': " . print_r($tour_data_raw, true));

                        // Map common field names
                        $tour_data = [
                            'id' => $tour_id,
                            'name' => $tour_data_raw['name'] ?? $tour_data_raw['title'] ?? $tour_data_raw['tour_name'] ?? 'Tour #' . $tour_id,
                            'description' => $tour_data_raw['description'] ?? $tour_data_raw['details'] ?? $tour_data_raw['overview'] ?? 'Tour details not available',
                            'duration' => $tour_data_raw['duration'] ?? $tour_data_raw['days'] ?? $tour_data_raw['tour_duration'] ?? 'N/A',
                            'location' => $tour_data_raw['location'] ?? $tour_data_raw['destination'] ?? $tour_data_raw['city'] ?? 'N/A',
                            'category' => $tour_data_raw['category'] ?? $tour_data_raw['type'] ?? $tour_data_raw['tour_type'] ?? 'N/A',
                            'base_price' => $tour_data_raw['price'] ?? $tour_data_raw['base_price'] ?? $tour_data_raw['adult_price'] ?? $base_price,
                            'includes' => $tour_data_raw['includes'] ?? $tour_data_raw['included'] ?? null,
                            'excludes' => $tour_data_raw['excludes'] ?? $tour_data_raw['excluded'] ?? null,
                            'itinerary' => $tour_data_raw['itinerary'] ?? $tour_data_raw['schedule'] ?? null
                        ];
                        break;
                    }
                } catch (Exception $table_error) {
                    error_log("Table '$table_name' doesn't exist or error: " . $table_error->getMessage());
                    continue;
                }
            }
        }
    } catch (Exception $e) {
        error_log("Error fetching tour data: " . $e->getMessage());
    }

    // If still no tour data found, create basic tour info
    if (!$tour_data) {
        error_log("No tour data found, using basic info for ID: $tour_id");
        $tour_data = [
            'id' => $tour_id,
            'name' => 'Tour #' . $tour_id,
            'description' => 'Tour details not available',
            'duration' => 'N/A',
            'location' => 'N/A',
            'category' => 'N/A',
            'base_price' => $base_price,
            'includes' => null,
            'excludes' => null,
            'itinerary' => null
        ];
    }

    // Fetch payment method information
    $payment_method = 'Unknown';
    if ($payment_method_id > 0) {
        try {
            $stmt = $mysqli->prepare("SELECT method_name FROM pay_method WHERE id = ?");
            $stmt->bind_param("i", $payment_method_id);
            $stmt->execute();
            $payment_result = $stmt->get_result();

            if ($payment_result->num_rows > 0) {
                $payment_data = $payment_result->fetch_assoc();
                $payment_method = $payment_data['method_name'];
            }
        } catch (Exception $payment_error) {
            error_log("Payment methods table not found or error: " . $payment_error->getMessage());
            $payment_method = 'Payment Method ID: ' . $payment_method_id;
        }
    }
    error_log("Payment method: $payment_method");

    // Check if customer already exists
    $stmt = $mysqli->prepare("SELECT id FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Customer exists, get the ID
        $customer = $result->fetch_assoc();
        $customer_id = $customer['id'];

        // Update customer information
        $stmt = $mysqli->prepare("
            UPDATE customers SET 
                first_name = ?, last_name = ?, phone = ?, additional_phone = ?, 
                address = ?, street_no = ?, city = ?, country = ?, zip = ?, 
                passport_number = ?, fly_number = ?, nationality = ?
            WHERE id = ?
        ");
        $stmt->bind_param(
            "ssssssssssssi",
            $first_name,
            $last_name,
            $phone,
            $additional_phone,
            $address,
            $street_no,
            $city,
            $country,
            $zip,
            $passport_number,
            $fly_number,
            $nationality,
            $customer_id
        );
        $stmt->execute();
        error_log("Updated existing customer ID: $customer_id");
    } else {
        // Insert new customer
        $stmt = $mysqli->prepare("
            INSERT INTO customers (
                first_name, last_name, email, phone, additional_phone, address, 
                street_no, city, country, zip, passport_number, fly_number, 
                nationality, is_verified
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)
        ");
        $stmt->bind_param(
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
        $stmt->execute();
        $customer_id = $mysqli->insert_id;
        error_log("Created new customer ID: $customer_id");
    }

    // Get private_tour_pricing_id based on group size
    $private_tour_pricing_id = null;
    if (!empty($group_size)) {
        $stmt = $mysqli->prepare("SELECT id FROM private_tour_pricing WHERE group_size = ?");
        $stmt->bind_param("s", $group_size);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $pricing = $result->fetch_assoc();
            $private_tour_pricing_id = $pricing['id'];
            error_log("Found private_tour_pricing_id: $private_tour_pricing_id for group_size: $group_size");
        } else {
            error_log("No private_tour_pricing found for group_size: $group_size");
        }
    }

    // Generate booking code
    $booking_code = 'JCY-B' . date('Ymd') . str_pad($customer_id, 4, '0', STR_PAD_LEFT) . rand(100, 999);

    // Insert booking
    $stmt = $mysqli->prepare("
        INSERT INTO booking_tour (
            booking_code, tour_id, private_tour_pricing_id, customer_id, book_date, 
            adults, children, child_under_5, child_5to11_50, child_5to11_75, 
            special_request, dietary_request, pay_method_id, status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')
    ");

    // Map your child categories to the database fields
    $children = $child12; // children field maps to child12
    $child_under_5 = $child0;
    $child_5to11_50 = $child50;
    $child_5to11_75 = $child75;

    $stmt->bind_param(
        "siiiiiiiisssi",
        $booking_code,
        $tour_id,
        $private_tour_pricing_id,
        $customer_id,
        $tour_date,
        $adults,
        $children,
        $child_under_5,
        $child_5to11_50,
        $child_5to11_75,
        $special_request,
        $dietary_request,
        $payment_method_id
    );
    $stmt->execute();

    $booking_id = $mysqli->insert_id;
    error_log("Created booking ID: $booking_id with code: $booking_code");

    // Commit transaction
    $mysqli->commit();

    // Prepare comprehensive data for Telegram notification
    $telegram_data = [
        'booking_code' => $booking_code,
        'booking_id' => $booking_id,
        'customer_name' => $first_name . ' ' . $last_name,
        'email' => $email,
        'phone' => $phone,
        'additional_phone' => $additional_phone,
        'address' => $address,
        'nationality' => $nationality,
        'passport_number' => $passport_number,
        'fly_number' => $fly_number,
        'tour_date' => $tour_date,
        'adults' => $adults,
        'child12' => $child12,
        'child75' => $child75,
        'child50' => $child50,
        'child0' => $child0,
        'base_price' => $base_price,
        'total_price' => $total_price,
        'group_size' => $group_size,
        'special_request' => $special_request,
        'dietary_request' => $dietary_request
    ];

    // Send enhanced Telegram notification with tour details
    $telegram_sent = sendTelegramNotification($telegram_data, $tour_data, $payment_method);
    if ($telegram_sent) {
        error_log("Enhanced Telegram notification sent successfully for booking: $booking_code");
    } else {
        error_log("Failed to send Telegram notification for booking: $booking_code");
    }

    // Clear localStorage and redirect to tours.php with success parameter
    echo "<script>
    localStorage.removeItem('package_booking_data');
    localStorage.removeItem('bookingData');
    // Store booking details for the success modal
    sessionStorage.setItem('bookingSuccess', JSON.stringify({
        booking_code: '" . $booking_code . "',
        booking_id: '" . $booking_id . "',
        customer_name: '" . addslashes($first_name . ' ' . $last_name) . "'
    }));
    // Set flag to indicate booking was just completed
    sessionStorage.setItem('bookingJustCompleted', 'true');
    window.location.href = '../tours.php?booking=success';
</script>";
} catch (Exception $e) {
    // Rollback transaction on error
    $mysqli->rollback();

    error_log("Booking submission error: " . $e->getMessage());
    echo "<script>
        alert('Error submitting booking: " . addslashes($e->getMessage()) . "');
        window.history.back();
    </script>";
}

$mysqli->close();
