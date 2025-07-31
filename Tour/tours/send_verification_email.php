<?php
header('Content-Type: application/json');
include '../config/db.php'; // your DB connection

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || empty($data['email']) || empty($data['code'])) {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit;
}

$email = $data['email'];
$code = $data['code'];
$fname = htmlspecialchars($data['fname']);
$lname = htmlspecialchars($data['lname']);
$phone = htmlspecialchars($data['phone']);

// Save or update pending verification
$stmt = $mysqli->prepare("INSERT INTO pending_verifications (email, code, fname, lname, phone, created_at)
    VALUES (?, ?, ?, ?, ?, NOW())
    ON DUPLICATE KEY UPDATE code = VALUES(code), fname = VALUES(fname), lname = VALUES(lname), phone = VALUES(phone), created_at = NOW()");
$stmt->bind_param("sssss", $email, $code, $fname, $lname, $phone);
if (!$stmt->execute()) {
    echo json_encode(["status" => "error", "message" => "DB error: " . $stmt->error]);
    exit;
}

// Prepare email
$to = $email;
$subject = "Your Verification Code";
$body = "
  <h2>Hello $fname,</h2>
  <p>Thanks for registering. Your 6-digit verification code is:</p>
  <h3 style='color:#574bff;'>$code</h3>
  <p>This code will expire in 10 minutes. Please do not share it.</p>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: JCY Tour <sreynairuby@gmail.com>" . "\r\n";

if (mail($to, $subject, $body, $headers)) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to send email"]);
}
