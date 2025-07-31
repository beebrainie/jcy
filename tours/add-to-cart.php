<?php
// File: actions/add-to-cart.php
require_once '../config/db.php';
session_start();

header('Content-Type: application/json');

try {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data) {
        throw new Exception("Invalid JSON input");
    }

    // Extract data
    $tourName = $data['tour_name'] ?? null;
    $privateTourPricingId = $data['group_id'] ?? null;
    $tourDate = $data['tour_date'] ?? null;
    $adults = intval($data['adults'] ?? 1);
    $children = intval(($data['child12'] ?? 0) + ($data['child75'] ?? 0) + ($data['child50'] ?? 0));
    $child_under_5 = intval($data['child0'] ?? 0);
    $child_5to11_50 = intval($data['child50'] ?? 0);
    $child_5to11_75 = intval($data['child75'] ?? 0);
    $totalPrice = floatval($data['total_price'] ?? 0);
    $image = $data['image'] ?? null;

    if (!$tourName || !$privateTourPricingId || !$tourDate) {
        throw new Exception("Missing required fields");
    }

    // Generate or get cart_id
    if (isset($_COOKIE['cart_id']) && preg_match('/^[a-f0-9]{32}$/', $_COOKIE['cart_id'])) {
        $cartId = $_COOKIE['cart_id'];
    } else {
        $cartId = bin2hex(random_bytes(16));
        setcookie('cart_id', $cartId, time() + 86400 * 30, "/");
    }

    // Slugify function
    function slugify($text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        return trim($text, '-');
    }

    $tourSlug = slugify($tourName);

    $stmt = $mysqli->prepare("SELECT id, tour_name FROM package_tours");
    if (!$stmt) throw new Exception("Prepare failed: " . $mysqli->error);

    $stmt->execute();
    $result = $stmt->get_result();

    $tourId = null;
    while ($row = $result->fetch_assoc()) {
        if (slugify($row['tour_name']) === $tourSlug) {
            $tourId = intval($row['id']);
            break;
        }
    }
    $stmt->close();

    if (!$tourId) {
        throw new Exception("Tour not found: " . htmlspecialchars($tourName));
    }

    // ✅ INSERT with `tour_date`
    $insertSQL = "INSERT INTO add_to_cart 
        (cart_id, tour_id, private_tour_pricing_id, tour_date, adults, children, child_under_5, child_5to11_50, child_5to11_75, total_price, image)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($insertSQL);
    if (!$stmt) {
        throw new Exception("Insert prepare failed: " . $mysqli->error);
    }

    $stmt->bind_param(
        "siissiiiids",
        $cartId,
        $tourId,
        $privateTourPricingId,
        $tourDate,
        $adults,
        $children,
        $child_under_5,
        $child_5to11_50,
        $child_5to11_75,
        $totalPrice,
        $image
    );

    if (!$stmt->execute()) {
        throw new Exception("Insert execute failed: " . $stmt->error);
    }

    $stmt->close();

    echo json_encode([
        'status' => 'success',
        'message' => 'Added to cart successfully',
        'cart_id' => $cartId,
        'tour_id' => $tourId
    ]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
