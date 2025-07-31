<?php
require_once '../config/db.php';

$tour_name = $_GET['tour_name'] ?? '';
if (!$tour_name) {
    echo json_encode(['error' => 'No tour name provided']);
    exit;
}

$tour_name = $mysqli->real_escape_string($tour_name);

$query = "SELECT * FROM package_tours WHERE tour_name = '$tour_name' LIMIT 1";
$result = $mysqli->query($query);

if (!$result || $result->num_rows === 0) {
    echo json_encode(['error' => 'Tour not found']);
    exit;
}

$tour = $result->fetch_assoc();

// Since you have durations as int (days), destinations as text, price_start as decimal, no image column
// Let's create reasonable fields to return for your front-end display:

echo json_encode([
    'id' => $tour['id'],
    'tour_name' => $tour['tour_name'],
    'duration' => $tour['durations'] . ' Days',            // Format duration for display
    'location' => $tour['destinations'],                    // Use destinations field for location display
    'price_start' => number_format($tour['price_start'], 2),
    'description' => $tour['description'] ?? '',
    'min_people' => $tour['min_people'],
    'max_people' => $tour['max_people'],
    // Add default image or a placeholder image path here since no image column
    'image' => 'assets/img/travel/default-tour.jpg'
]);
