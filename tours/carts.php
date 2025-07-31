<?php
include '../partials/__head.php';
include '../partials/__subhero.php';
require_once '../config/db.php';

$cartId = $_COOKIE['cart_id'] ?? null;

if (!$cartId) {
  echo "<div class='container my-5'><p class='text-center'>No cart found. Please add some tours first.</p></div>";
  include '../partials/__footer.php';
  exit;
}

// Fetch cart items with tour details
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
  echo "<div class='container my-5'><p class='text-center'>Your cart is empty.</p></div>";
  include '../partials/__footer.php';
  exit;
}

// Calculate totals
$totalItems = count($cartItems);
$subtotalPrice = array_sum(array_column($cartItems, 'total_price'));
?>

<style>
  .cart-card {
    border-radius: 20px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    margin-bottom: 30px;
    transition: transform 0.2s ease-in-out;
  }

  .cart-card:hover {
    transform: translateY(-5px);
  }

  .cart-card img {
    object-fit: cover;
    height: 220px;
    width: 100%;
  }
</style>

<main class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4">Your Cart (<?= $totalItems ?> item<?= $totalItems > 1 ? 's' : '' ?>)</h2>

    <div class="row">
      <?php foreach ($cartItems as $item): ?>
        <div class="col-md-6 col-lg-4">
          <div class="cart-card bg-white">
            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['tour_name']) ?>">
            <div class="p-3">
              <h5 class="fw-bold mb-2"><?= htmlspecialchars($item['tour_name']) ?></h5>
              <ul class="mb-2 small">
                <li>Adults: <?= $item['adults'] ?></li>
                <li>Children: <?= $item['children'] ?></li>
                <li>Under 5: <?= $item['child_under_5'] ?></li>
                <li>Age 5-11 (50%): <?= $item['child_5to11_50'] ?></li>
                <li>Age 5-11 (75%): <?= $item['child_5to11_75'] ?></li>
              </ul>
              <p class="fw-semibold text-primary">Total: $<?= number_format($item['total_price'], 2) ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Cart Summary -->
    <div class="mt-4 p-4 bg-white rounded shadow-sm">
      <h4 class="mb-3">Cart Summary</h4>
      <p><strong>Total Items:</strong> <?= $totalItems ?></p>
      <p><strong>Subtotal:</strong> $<?= number_format($subtotalPrice, 2) ?></p>
      <a href="book-now.php" class="btn btn-primary">Proceed to Checkout</a>
    </div>
  </div>
</main>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include '../partials/__footer.php'; ?>

<!-- Scripts -->
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>
<script src="../assets/vendor/aos/aos.js"></script>
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="../assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../assets/js/main.js"></script>