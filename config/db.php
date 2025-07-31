<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'jcytour-test');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Optional: Set charset
$mysqli->set_charset("utf8mb4");
