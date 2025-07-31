<?php
session_start();
require_once '../config/db.php'; // your DB connection file

// Sanitize and fetch POST data (trimmed)
$first_name = trim($_POST['first_name'] ?? '');
$last_name = trim($_POST['last_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$street_no = trim($_POST['street_no'] ?? '');
$city = trim($_POST['city'] ?? '');
$country = trim($_POST['country'] ?? '');
$zip = trim($_POST['zip'] ?? '');
$passport_number = trim($_POST['passport_number'] ?? '');
$fly_number = trim($_POST['fly_number'] ?? '');
$nationality = trim($_POST['nationality'] ?? '');

// Basic required field check
if (!$first_name || !$last_name || !$email || !$phone) {
    die("Missing required customer info.");
}

// Generate 6-character verification code (alphanumeric uppercase)
function generateVerificationCode($length = 6)
{
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $chars[random_int(0, strlen($chars) - 1)];
    }
    return $code;
}

$verification_code = generateVerificationCode();

// Prepare the insert statement
$stmt = $mysqli->prepare("INSERT INTO customers (first_name, last_name, email, phone, address, street_no, city, country, zip, passport_number, fly_number, nationality, verification_code, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)");

if (!$stmt) {
    die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
}

$stmt->bind_param(
    "sssssssssssss",
    $first_name,
    $last_name,
    $email,
    $phone,
    $address,
    $street_no,
    $city,
    $country,
    $zip,
    $passport_number,
    $fly_number,
    $nationality,
    $verification_code
);

if (!$stmt->execute()) {
    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
}

$customer_id = $stmt->insert_id;
$stmt->close();

// Save tour info to session for next steps
$_SESSION['customTourInfo'] = [
    'destinations' => $_POST['destinations'] ?? [],
    'tour_type_id' => $_POST['tour_type_id'] ?? '',
    'accommodation_type_id' => $_POST['accommodation_type_id'] ?? '',
    'travel_style' => $_POST['travel_style'] ?? '',
    'travelers_adults' => $_POST['travelers_adults'] ?? '',
    'travelers_children' => $_POST['travelers_children'] ?? '',
    'hotel_rooms' => $_POST['hotel_rooms'] ?? '',
    'travel_date' => $_POST['travel_date'] ?? '',
    'trip_days' => $_POST['trip_days'] ?? '',
    'budget_per_person' => $_POST['budget_per_person'] ?? '',
    'international_flight' => isset($_POST['international_flight']) ? 'Yes' : 'No'
];

$_SESSION['customer_id'] = $customer_id;

// Redirect to signup.php for verification step
header("Location: signup.php");
exit;
