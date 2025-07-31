<?php
require_once '../vendor/autoload.php';
session_start();

$client = new Google_Client();
$client->setClientId('992697303030-0vh5ia3r405dkrufjh3mhn4iojcnjdd4.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost:3000/google-callback.php'); // your redirect URI
$client->addScope('email');
$client->addScope('profile');

$login_url = $client->createAuthUrl();
?>
<a href="<?= htmlspecialchars($login_url) ?>">Sign in with Google</a>