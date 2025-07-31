<?php
require_once '../vendor/autoload.php';
require_once '../config/db.php'; // your DB connection
session_start();

$client = new Google_Client();
$client->setClientId('992697303030-0vh5ia3r405dkrufjh3mhn4iojcnjdd4.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost:3000/google-callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);
        $oauth2 = new Google_Service_Oauth2($client);
        $userinfo = $oauth2->userinfo->get();

        $email = $userinfo->email;
        $name = $userinfo->name;

        // Check if user exists
        $stmt = $mysqli->prepare("SELECT id FROM customers WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $stmt = $mysqli->prepare("INSERT INTO customers (first_name, email, provider, created_at) VALUES (?, ?, 'google', NOW())");
            $stmt->bind_param('ss', $name, $email);
            $stmt->execute();
        }

        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;

        header('Location: booking.php');
        exit;
    } else {
        echo "Error fetching access token.";
    }
} else {
    echo "No authorization code found.";
}
