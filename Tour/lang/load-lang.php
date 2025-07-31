<?php
session_start();

$supported_langs = ['en', 'kh', 'ch', 'fr','vn'];

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en'; // default
}

if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_langs)) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'];
$lang_path = __DIR__ . "/lang/{$lang}.php";

if (!file_exists($lang_path)) {
    $lang_path = __DIR__ . "/lang/en.php"; // fallback
}

$text = require $lang_path;
