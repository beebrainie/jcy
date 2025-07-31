<?php
include '../partials/__head.php';
include '../partials/__subhero.php';

require_once '../config/db.php';

$tourInfo = null;

// Example: get tour_id from GET param (adjust as needed)
$tour_id = isset($_GET['tour_id']) ? (int)$_GET['tour_id'] : 0;

if ($tour_id > 0) {
  $stmt = $mysqli->prepare("SELECT * FROM package_tours WHERE id = ?");
  $stmt->bind_param("i", $tour_id);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows) {
    $tourInfo = $result->fetch_assoc();
  }
  $stmt->close();
}
?>

<main class="main">
  <!-- Travel Booking Section -->
  <section id="travel-booking" class="travel-booking section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row">
        <div class="col-lg-8">
          <div class="booking-form-container">
            <!-- Progress Steps -->
            <div class="booking-progress nav nav-tabs">
              <button class="step nav-link active" data-bs-toggle="tab" data-bs-target="#travel-booking-step-1">
                <span class="step-number">1</span>
                <span class="step-title">Travelers</span>
              </button>
              <button class="step nav-link" data-bs-toggle="tab" data-bs-target="#travel-booking-step-2">
                <span class="step-number">2</span>
                <span class="step-title">Add-ons</span>
              </button>
              <button class="step nav-link" data-bs-toggle="tab" data-bs-target="#travel-booking-step-3">
                <span class="step-number">3</span>
                <span class="step-title">Payment</span>
              </button>
            </div>

            <!-- End Progress Steps -->

            <!-- Booking Form -->
            <form action="" method="post" class="booking-form" data-aos="fade-up" data-aos-delay="300">

              <div class="tab-content" id="bookingTabContent">

                <!-- Step 1: Traveler Information -->
                <div class="form-step tab-pane fade show active" id="travel-booking-step-1" role="tabpanel">
                  <h4>Traveler Information</h4>

                  <div class="traveler-info">
                    <h5>Lead Traveler</h5>
                    <div class="row gy-3">
                      <div class="col-md-6">
                        <label for="first-name">First Name</label>
                        <input type="text" name="first_name" id="first-name" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                        <label for="last-name">Last Name</label>
                        <input type="text" name="last_name" id="last-name" class="form-control" required>
                      </div>

                      <div class="col-md-6">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                        <label for="phone">Phone Number</label>
                        <input type="tel" name="phone" id="phone" class="form-control" required>
                      </div>

                      <div class="col-md-12">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                      </div>

                      <div class="col-md-6">
                        <label for="street-no">Street No</label>
                        <input type="text" name="street_no" id="street-no" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" class="form-control">
                      </div>

                      <div class="col-md-6">
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label for="zip">ZIP / Postal Code</label>
                        <input type="text" name="zip" id="zip" class="form-control">
                      </div>

                      <div class="col-md-6">
                        <label for="passport-number">Passport Number</label>
                        <input type="text" name="passport_number" id="passport-number" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label for="fly-number">Flight Number</label>
                        <input type="text" name="fly_number" id="fly-number" class="form-control">
                      </div>

                      <div class="col-md-6">
                        <label for="nationality">Nationality</label>
                        <input type="text" name="nationality" id="nationality" class="form-control" required>
                      </div>
                    </div>
                  </div>

                  <div class="special-requirements mt-4">
                    <h5>Special Requirements</h5>
                    <div class="row gy-3">
                      <div class="col-12">
                        <label for="dietary">Dietary Restrictions</label>
                        <textarea name="dietary" id="dietary" class="form-control" rows="3" placeholder="Please mention any dietary restrictions or food allergies..."></textarea>
                      </div>
                      <div class="col-12">
                        <label for="special-requests">Special Requests</label>
                        <textarea name="special_requests" id="special-requests" class="form-control" rows="3" placeholder="Any special requests or accessibility needs..."></textarea>
                      </div>
                    </div>
                  </div>
                </div>


                <!-- Step 2: Add-ons & Extras -->
                <div class="form-step tab-pane fade" id="travel-booking-step-2" role="tabpanel">
                  <h4>Enhance Your Experience</h4>

                  <div class="addon-options">
                    <div class="addon-item">
                      <div class="addon-details">
                        <div class="addon-check">
                          <input type="checkbox" name="travel_insurance" disabled id="travel-insurance" value="yes">
                          <label for="travel-insurance">
                            <h5>Travel Insurance</h5>
                            <p>Comprehensive coverage for your trip including medical emergencies and cancellations.</p>
                          </label>
                        </div>
                        <div class="addon-price">
                          <span class="price">$89</span>
                          <span class="period">per person</span>
                        </div>
                      </div>
                    </div>

                    <div class="addon-item">
                      <div class="addon-details">
                        <div class="addon-check">
                          <input type="checkbox" name="airport_transfer" disabled id="airport-transfer" value="yes">
                          <label for="airport-transfer">
                            <h5>Airport Transfer</h5>
                            <p>Private pickup and drop-off service from/to the airport with comfortable vehicle.</p>
                          </label>
                        </div>
                        <div class="addon-price">
                          <span class="price">$45</span>
                          <span class="period">per trip</span>
                        </div>
                      </div>
                    </div>

                    <div class="addon-item">
                      <div class="addon-details">
                        <div class="addon-check">
                          <input type="checkbox" name="extra_nights" disabled id="extra-nights" value="yes">
                          <label for="extra-nights">
                            <h5>Extra Hotel Nights</h5>
                            <p>Extend your stay with additional nights at premium hotels before or after your tour.</p>
                          </label>
                        </div>
                        <div class="addon-price">
                          <span class="price">$120</span>
                          <span class="period">per night</span>
                        </div>
                      </div>
                    </div>

                    <div class="addon-item">
                      <div class="addon-details">
                        <div class="addon-check">
                          <input type="checkbox" name="local_guide" id="local-guide" value="yes">
                          <label for="local-guide">
                            <h5>Private Local Guide</h5>
                            <p>Personal guide for exclusive insights and customized exploration of hidden gems.</p>
                          </label>
                        </div>
                        <div class="addon-price">
                          <span class="price">$199</span>
                          <span class="period">per day</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- End Step 3 -->

                <!-- Step 3: Payment Information -->
                <div class="form-step tab-pane fade" id="travel-booking-step-3" role="tabpanel">
                  <h4>Payment Information</h4>

                  <div class="payment-methods">
                    <div class="method-selector">
                      <input type="radio" name="payment_method" id="credit-card" value="credit_card" checked="">
                      <label for="credit-card"><i class="bi bi-credit-card"></i> Credit Card</label>
                    </div>
                    <div class="method-selector">
                      <input type="radio" name="payment_method" id="paypal" value="paypal">
                      <label for="paypal"><i class="bi bi-paypal"></i> PayPal</label>
                    </div>
                    <div class="method-selector">
                      <input type="radio" name="payment_method" id="bank-transfer" value="bank_transfer">
                      <label for="bank-transfer"><i class="bi bi-bank"></i> Bank Transfer</label>
                    </div>
                  </div>

                  <div class="payment-details">
                    <div class="row gy-3">
                      <div class="col-12">
                        <label for="card-name">Cardholder Name</label>
                        <input type="text" name="card_name" id="card-name" class="form-control" required="">
                      </div>
                      <div class="col-md-8">
                        <label for="card-number">Card Number</label>
                        <input type="text" name="card_number" id="card-number" class="form-control" placeholder="1234 5678 9012 3456" required="">
                      </div>
                      <div class="col-md-4">
                        <label for="card-cvv">CVV</label>
                        <input type="text" name="card_cvv" id="card-cvv" class="form-control" placeholder="123" required="">
                      </div>
                      <div class="col-md-6">
                        <label for="card-expiry-month">Expiry Month</label>
                        <select name="card_expiry_month" id="card-expiry-month" class="form-select" required="">
                          <option value="">Month</option>
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="card-expiry-year">Expiry Year</label>
                        <select name="card_expiry_year" id="card-expiry-year" class="form-select" required="">
                          <option value="">Year</option>
                          <option value="2024">2024</option>
                          <option value="2025">2025</option>
                          <option value="2026">2026</option>
                          <option value="2027">2027</option>
                          <option value="2028">2028</option>
                          <option value="2029">2029</option>
                        </select>
                      </div>
                    </div>

                    <div class="secure-payment">
                      <i class="bi bi-shield-check"></i>
                      <span>Your payment information is secure and encrypted</span>
                    </div>
                  </div>

                  <div class="terms-agreement">
                    <div class="form-check">
                      <input type="checkbox" name="terms_agreement" id="terms-agreement" class="form-check-input" required="">
                      <label for="terms-agreement" class="form-check-label">
                        I agree to the <a href="#">Terms &amp; Conditions</a> and <a href="#">Privacy Policy</a>
                      </label>
                    </div>
                  </div>

                  <div class="form-navigation">
                    <button type="submit" class="btn btn-book">Complete Booking</button>
                  </div>
                </div><!-- End Step 4 -->

              </div><!-- End Tab Content -->

            </form><!-- End Booking Form -->
          </div>
        </div>

        <!-- Booking Summary Sidebar -->
        <div class="col-lg-4">

          <div class="booking-summary" data-aos="fade-up" data-aos-delay="400">
            <div class="summary-header">
              <h4>Booking Summary</h4>
            </div>

            <div class="selected-tour">
              <img src="" alt="Selected Tour" class="img-fluid">
              <?php if ($tourInfo): ?>
                <div class="full-tour-info mt-3">
                  <p><strong>Destinations:</strong> <?= htmlspecialchars($tourInfo['destinations']) ?></p>
                  <p><strong>Duration:</strong> <?= htmlspecialchars($tourInfo['durations']) ?> days</p>
                  <p><strong>Group Size:</strong> Min <?= htmlspecialchars($tourInfo['min_people'] ?? '-') ?> - Max <?= htmlspecialchars($tourInfo['max_people'] ?? '-') ?></p>
                  <p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($tourInfo['description'])) ?></p>
                  <p><strong>Price Starts At:</strong> $<?= htmlspecialchars($tourInfo['price_start']) ?></p>
                </div>
              <?php endif; ?>

            </div>

            <div class="booking-details">
              <div class="detail-item">
                <span class="label">Departure:</span>
                <span class="value" id="summary-departure">Select dates</span>
              </div>
              <div class="detail-item">
                <span class="label">Travelers:</span>
                <span class="value" id="summary-travelers">-</span>
              </div>
              <div class="detail-item">
                <span class="label">Duration:</span>
                <span class="value" id="summary-duration">-</span>
              </div>
              <div class="detail-item">
                <span class="label">Flight:</span>
                <span class="value" id="summary-flight">-</span>
              </div>
              <div class="detail-item">
                <span class="label">Group Size:</span>
                <span class="value" id="summary-group-size">-</span>
              </div>

              <div class="detail-item">
                <span class="label">Adults:</span>
                <span class="value" id="summary-adults">0</span>
              </div>

              <div class="detail-item">
                <span class="label">Child (12+):</span>
                <span class="value" id="summary-child12">0</span>
              </div>

              <div class="detail-item">
                <span class="label">Child (5–11) with bed:</span>
                <span class="value" id="summary-child75">0</span>
              </div>

              <div class="detail-item">
                <span class="label">Child (5–11) no bed:</span>
                <span class="value" id="summary-child50">0</span>
              </div>

              <div class="detail-item">
                <span class="label">Child (under 5):</span>
                <span class="value" id="summary-child0">0</span>
              </div>

            </div>

            <div class="price-breakdown">
              <div class="price-item base-price">
                <span class="description">Base Price</span>
                <span class="amount" id="base-price-amount">$0.00</span>
              </div>
              <!-- Add-ons and other prices can go here -->
              <div class="price-total">
                <span class="description">Total Amount</span>
                <span class="amount" id="total-price-amount">$0.00</span>
              </div>
            </div>

            <div class="help-section">
              <h5>Need Help?</h5>
              <p>Our travel experts are here to assist you</p>
              <div class="contact-info">
                <p><i class="bi bi-telephone"></i> (+855) 97 559 0178</p>
                <p><i class="bi bi-envelope"></i> sales@jcytour.com</p>
              </div>
              <div class="support-hours">
                <small>Available 24/7</small>
              </div>
            </div>
          </div>
        </div>




      </div>
    </div>
    </div>

  </section>
  <!-- /Travel Booking Section -->
</main>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const bookingRaw = localStorage.getItem("package_booking_data");
    if (!bookingRaw) return;

    try {
      const bookingData = JSON.parse(bookingRaw);

      // Booking Summary section
      const summary = document.getElementById("booking-summary");
      summary.innerHTML = `
        <div class="card p-3 shadow-sm border-0">
          <h5 class="fw-bold">${bookingData.tour_name || ""}</h5>
          <p class="mb-1">${bookingData.duration || ""} | ${bookingData.category || ""}</p>
          <p class="mb-1">Date: ${bookingData.travel_date || ""}</p>
          <p class="mb-1">Adults: ${bookingData.adults || 0}, Children: ${bookingData.children || 0}</p>
          <p class="mb-1">Includes Flight: ${bookingData.flight_offer ? "Yes" : "No"}</p>
          <p class="mb-1">Visa & Permit: ${bookingData.visa_permit || "N/A"}</p>
          <h6 class="fw-bold text-primary mt-2">Total: $${bookingData.total_price || 0}</h6>
        </div>
      `;

      // Auto-fill traveler info form fields
      if (bookingData.first_name) document.getElementById('first-name').value = bookingData.first_name;
      if (bookingData.last_name) document.getElementById('last-name').value = bookingData.last_name;
      if (bookingData.email) document.getElementById('email').value = bookingData.email;
      if (bookingData.phone) document.getElementById('phone').value = bookingData.phone;
      if (bookingData.address) document.getElementById('address').value = bookingData.address;
      if (bookingData.street_no) document.getElementById('street-no').value = bookingData.street_no;
      if (bookingData.city) document.getElementById('city').value = bookingData.city;
      if (bookingData.country) document.getElementById('country').value = bookingData.country;
      if (bookingData.zip) document.getElementById('zip').value = bookingData.zip;
      if (bookingData.passport_number) document.getElementById('passport-number').value = bookingData.passport_number;
      if (bookingData.fly_number) document.getElementById('fly-number').value = bookingData.fly_number;
      if (bookingData.nationality) document.getElementById('nationality').value = bookingData.nationality;
      if (bookingData.dietary) document.getElementById('dietary').value = bookingData.dietary;
      if (bookingData.special_requests) document.getElementById('special-requests').value = bookingData.special_requests;

      // Optional: payment info (if you're storing this — use with caution)
      if (bookingData.card_name) document.getElementById('card-name').value = bookingData.card_name;
      if (bookingData.card_number) document.getElementById('card-number').value = bookingData.card_number;
      if (bookingData.card_cvv) document.getElementById('card-cvv').value = bookingData.card_cvv;
      if (bookingData.card_expiry_month) document.getElementById('card-expiry-month').value = bookingData.card_expiry_month;
      if (bookingData.card_expiry_year) document.getElementById('card-expiry-year').value = bookingData.card_expiry_year;

    } catch (e) {
      console.error("Error parsing localStorage booking data:", e);
    }
  });
</script>


<style>
  .step.disabled {
    pointer-events: none;
    opacity: 0.5;
    cursor: not-allowed;
  }
</style>


<?php include '../partials/_footer.php' ?>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>


<!-- Vendor JS Files -->
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/php-email-form/validate.js"></script>
<script src="/assets/vendor/aos/aos.js"></script>
<script src="/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>

<!-- Main JS File -->
<script src="/assets/js/main.js"></script>

</body>

</html>