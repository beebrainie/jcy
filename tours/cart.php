<?php
include '../partials/__head.php';
include '../partials/__subhero.php';

// cart.php
require_once '../config/db.php';

$cartId = $_COOKIE['cart_id'] ?? null;

if (!$cartId) {
    echo "<p>No cart found. Please add some tours first.</p>";
    exit;
}

// Query to get all cart items with tour name
$sql = "SELECT ac.id, ac.cart_id, ac.adults, ac.children, ac.child_under_5, ac.child_5to11_50, ac.child_5to11_75,
ac.total_price, ac.image, pt.tour_name
FROM add_to_cart ac
JOIN package_tours pt ON ac.tour_id = pt.id
WHERE ac.cart_id = ?
ORDER BY ac.created_at DESC";

$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
}
$stmt->bind_param("s", $cartId);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}
$stmt->close();

if (count($cartItems) === 0) {
    echo "<p>Your cart is empty.</p>";
    exit;
}

// Calculate subtotal count and total price
$totalItems = count($cartItems);
$subtotalPrice = 0;
foreach ($cartItems as $item) {
    $subtotalPrice += $item['total_price'];
}
?>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 1.5rem;
        background-color: #f7f8fa;
        color: #333;
    }

    .cart-container {
        max-width: 900px;
        margin: 0 auto;
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .cart-items {
        flex: 2 1 600px;
        background: #fff;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        overflow-y: auto;
        max-height: 75vh;
    }

    .cart-item {
        display: flex;
        gap: 1.2rem;
        border: 1px solid #e1e4ea;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
        align-items: center;
        transition: box-shadow 0.25s ease;
        background-color: #fff;
    }

    .cart-item:hover {
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .cart-item img {
        width: 100px;
        height: 75px;
        object-fit: cover;
        border-radius: 10px;
        flex-shrink: 0;
        background: #ddd;
        border: 1px solid #ccc;
    }

    .item-details {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .item-title {
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 0.3rem;
        text-transform: uppercase;
        color: #222;
    }

    .item-desc {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 0.6rem;
        font-style: italic;
        line-height: 1.3;
    }

    .item-qty {
        font-size: 0.95rem;
        color: #444;
        margin-bottom: 0.7rem;
    }

    .item-actions {
        font-size: 0.9rem;
    }

    .manage-btn,
    .remove-btn {
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        transition: background-color 0.3s ease;
        user-select: none;
    }

    .manage-btn {
        color: #1d7be0;
        background: #e8f0fe;
        margin-right: 1rem;
    }

    .manage-btn:hover {
        background: #c5d9fc;
    }

    .remove-btn {
        color: #d9534f;
        background: #fcebea;
    }

    .remove-btn:hover {
        background: #f9c6c3;
    }

    .item-price {
        font-weight: 700;
        font-size: 1.1rem;
        min-width: 110px;
        text-align: right;
        color: #222;
    }

    /* Summary Panel */
    .cart-summary {
        flex: 1 1 250px;
        background: linear-gradient(135deg, #ffb347 0%, #ffcc33 100%);
        border-radius: 16px;
        padding: 2rem 1.8rem;
        color: #3c2f00;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: 0 8px 20px rgba(255, 181, 71, 0.4);
    }

    .summary-subtotal {
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 1.6rem;
        text-align: center;
        line-height: 1.4;
        letter-spacing: 0.04em;
    }

    .book-now-btn {
        background-color: #ff7700;
        border: none;
        color: #fff;
        padding: 0.75rem 2.4rem;
        font-weight: 800;
        border-radius: 30px;
        cursor: pointer;
        font-size: 1.1rem;
        box-shadow: 0 4px 10px rgba(255, 119, 0, 0.6);
        transition: background-color 0.25s ease;
        margin-bottom: 1rem;
        width: 100%;
        max-width: 220px;
        text-align: center;
    }

    .book-now-btn:hover {
        background-color: #e56700;
    }

    .summary-note {
        font-size: 0.85rem;
        color: #462f00;
        font-style: italic;
        text-align: center;
    }

    /* Responsive */
    @media (max-width: 700px) {
        .cart-container {
            flex-direction: column;
            gap: 1.5rem;
        }

        .cart-items,
        .cart-summary {
            flex: unset;
            max-height: none;
            width: 100%;
        }

        .cart-item img {
            width: 90px;
            height: 65px;
        }
    }
</style>

<script>
    function handleManage(id) {
        // Redirect to manage page for editing item quantity or details
        window.location.href = 'manage-cart-item.php?id=' + encodeURIComponent(id);
    }

    async function handleRemove(id) {
        if (!confirm("Are you sure you want to remove this item?")) return;

        try {
            const res = await fetch('actions/remove-from-cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id
                })
            });
            const data = await res.json();

            if (data.status === 'success') {
                alert('Item removed from cart.');
                location.reload();
            } else {
                alert('Failed to remove item: ' + (data.message || 'Unknown error'));
            }
        } catch (error) {
            alert('Network error. Please try again.');
        }
    }
</script>

<div class="cart-container" role="main" aria-label="Shopping Cart">
    <section class="cart-items" aria-label="Cart Items List">
        <?php foreach ($cartItems as $item): ?>
            <article class="cart-item" aria-label="Cart item: <?= htmlspecialchars($item['tour_name']) ?>">
                <img
                    src="<?= htmlspecialchars($item['image'] ?: '../assets/img/default-tour.jpg') ?>"
                    alt="Image of <?= htmlspecialchars($item['tour_name']) ?>"
                    loading="lazy"
                    width="100" height="75" />
                <div class="item-details">
                    <h3 class="item-title"><?= htmlspecialchars($item['tour_name']) ?></h3>
                    <p class="item-desc">Experience this amazing tour tailored just for you!</p>
                    <p class="item-qty" aria-live="polite">
                        Adults: <?= intval($item['adults']) ?> &nbsp;|&nbsp;
                        Children: <?= intval($item['children'] + $item['child_under_5'] + $item['child_5to11_50'] + $item['child_5to11_75']) ?>
                    </p>
                    <div class="item-actions">
                        <button class="manage-btn" type="button" aria-label="Manage item <?= htmlspecialchars($item['tour_name']) ?>" onclick="handleManage(<?= (int)$item['id'] ?>)">Manage</button>
                        <button class="remove-btn" type="button" aria-label="Remove item <?= htmlspecialchars($item['tour_name']) ?>" onclick="handleRemove(<?= (int)$item['id'] ?>)">Remove</button>
                    </div>
                </div>
                <div class="item-price" aria-label="Price for this item">
                    USD$ <?= number_format($item['total_price'], 2) ?>
                </div>
            </article>
        <?php endforeach; ?>
    </section>

    <aside class="cart-summary" aria-label="Cart summary and checkout">
        <div class="summary-subtotal" aria-live="polite">
            Subtotal (<?= $totalItems ?> items) <br>
            <strong>USD$ <?= number_format($subtotalPrice, 2) ?></strong>
        </div>
        <button class="book-now-btn" type="button" onclick="window.location.href='checkout.php'">Book Now</button>
        <div class="summary-note">Ready for your next adventure? Let's go!</div>
    </aside>
</div>