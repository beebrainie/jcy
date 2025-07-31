<?php
include '../partials/__head.php';
include '../partials/__subhero.php';
require_once '../config/db.php';

$tourInfo = null;
if (isset($_GET['tour_id']) && is_numeric($_GET['tour_id'])) {
  $tour_id = intval($_GET['tour_id']);
  $stmt = $mysqli->prepare("SELECT * FROM package_tours WHERE id = ?");
  $stmt->bind_param("i", $tour_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $tourInfo = $result->fetch_assoc();
  } else {
    echo "<div style='color: red; text-align: center;'>No tour found with ID: $tour_id</div>";
  }

  $stmt->close();
} else {
  echo "<div style='color: red; text-align: center;'>No tour ID passed in URL.</div>";
}
?>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const bookingRaw =
      localStorage.getItem("package_booking_data") ||
      localStorage.getItem("bookingData");
    const userRaw = localStorage.getItem("registeredUser");

    // Early exit if no booking data
    if (!bookingRaw) {
      console.warn("No booking data found in localStorage.");
      return;
    }

    try {
      const booking = JSON.parse(bookingRaw);
      console.log("Parsed bookingData:", booking);

      // Redirect if no tour_id in URL but exists in booking data
      if (booking.tour_id && !window.location.search.includes("tour_id")) {
        const newUrl = `${window.location.pathname}?tour_id=${booking.tour_id}`;
        window.location.href = newUrl;
        return; // stop further script on this redirect
      }

      // Set hidden input tour_id
      const tourInput = document.getElementById("tour_id_input");
      if (tourInput && booking.tour_id) {
        tourInput.value = booking.tour_id;
      }

      // Update booking summary details
      const totalTravelers =
        (parseInt(booking.adults) || 0) +
        (parseInt(booking.child12) || 0) +
        (parseInt(booking.child75) || 0) +
        (parseInt(booking.child50) || 0) +
        (parseInt(booking.child0) || 0);

      const updateText = (id, value, defaultVal = '-') => {
        const el = document.getElementById(id);
        if (el) el.textContent = value || defaultVal;
      };

      updateText("summary-departure", booking.tour_date);
      updateText("summary-travelers", totalTravelers);
      updateText("summary-duration", booking.duration ? `${booking.duration} days` : '-');
      updateText("summary-flight", booking.fly_number);
      updateText("summary-group-size", booking.group_key);
      updateText("summary-top-group-size", booking.group_key);
      updateText("summary-adults", booking.adults || 0);
      updateText("summary-child12", booking.child12 || 0);
      updateText("summary-child75", booking.child75 || 0);
      updateText("summary-child50", booking.child50 || 0);
      updateText("summary-child0", booking.child0 || 0);
      updateText("base-price-amount", `$${(booking.base_price || 0).toFixed(2)}`);
      updateText("total-price-amount", `$${(booking.total_price || 0).toFixed(2)}`);

      // Set image
      const tourImage = document.getElementById("summary-tour-image");
      if (tourImage && booking.image) {
        tourImage.src = booking.image;
      }

      // Autofill traveler form inputs
      const fields = [
        "first_name", "last_name", "email", "phone", "address", "street_no",
        "city", "country", "zip", "passport_number", "fly_number",
        "nationality", "dietary", "special_requests"
      ];

      fields.forEach(field => {
        const el = document.getElementById(field.replace("_", "-"));
        if (el && booking[field]) el.value = booking[field];
      });

    } catch (e) {
      console.error("Failed to parse booking data from localStorage:", e);
    }

    // Populate user info (from signup)
    if (userRaw) {
      try {
        const user = JSON.parse(userRaw);
        if (user.fname) document.getElementById("first-name").value = user.fname;
        if (user.lname) document.getElementById("last-name").value = user.lname;
        if (user.email) document.getElementById("email").value = user.email;
        if (user.phone) document.getElementById("phone").value = user.phone;
      } catch (e) {
        console.error("Invalid user data in localStorage:", e);
      }
    }

    // FIXED: Move form submission event listener inside DOMContentLoaded
    const bookingForm = document.querySelector('form.booking-form');
    if (bookingForm) {
      bookingForm.addEventListener('submit', function(e) {
        const bookingRaw = localStorage.getItem("package_booking_data") || localStorage.getItem("bookingData");

        if (!bookingRaw) {
          alert('No booking data found. Please start the booking process again.');
          e.preventDefault();
          return;
        }

        try {
          const booking = JSON.parse(bookingRaw);

          // Validate required booking data
          if (!booking.tour_date || !booking.tour_id) {
            alert('Missing tour information. Please start the booking process again.');
            e.preventDefault();
            return;
          }

          // Set all hidden fields
          document.getElementById('input-tour-date').value = booking.tour_date || '';
          document.getElementById('input-adults').value = booking.adults || 1;
          document.getElementById('input-child12').value = booking.child12 || 0;
          document.getElementById('input-child75').value = booking.child75 || 0;
          document.getElementById('input-child50').value = booking.child50 || 0;
          document.getElementById('input-child0').value = booking.child0 || 0;
          document.getElementById('input-base-price').value = booking.base_price || 0;
          document.getElementById('input-total-price').value = booking.total_price || 0;
          document.getElementById('input-group-size').value = booking.group_key || '';

          // Validate form fields
          const requiredFields = ['first-name', 'last-name', 'email', 'phone', 'address', 'nationality'];
          const missingFields = [];

          requiredFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (!field || !field.value.trim()) {
              missingFields.push(fieldId.replace('-', ' '));
            }
          });

          if (missingFields.length > 0) {
            alert('Please fill in the following required fields: ' + missingFields.join(', '));
            e.preventDefault();
            return;
          }

          console.log('Form data being submitted:', {
            tour_id: document.getElementById('tour_id_input').value,
            tour_date: document.getElementById('input-tour-date').value,
            adults: document.getElementById('input-adults').value,
            group_size: document.getElementById('input-group-size').value,
            first_name: document.getElementById('first-name').value,
            last_name: document.getElementById('last-name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            address: document.getElementById('address').value,
            nationality: document.getElementById('nationality').value
          });

        } catch (e) {
          console.error("Failed to parse booking data for submission:", e);
          alert('Error processing booking data. Please try again.');
          e.preventDefault();
        }
      });
    }
  });
</script>

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
            <form action="submit-package-booking.php" method="post" class="booking-form" data-aos="fade-up" data-aos-delay="300">
              <!-- FIXED: Removed duplicate tour_date input -->
              <input type="hidden" name="tour_id" id="tour_id_input" value="">
              <input type="hidden" name="tour_date" id="input-tour-date" value="">
              <input type="hidden" name="group_size" id="input-group-size" value="">
              <input type="hidden" name="adults" id="input-adults" value="">
              <input type="hidden" name="child12" id="input-child12" value="">
              <input type="hidden" name="child75" id="input-child75" value="">
              <input type="hidden" name="child50" id="input-child50" value="">
              <input type="hidden" name="child0" id="input-child0" value="">
              <input type="hidden" name="base_price" id="input-base-price" value="">
              <input type="hidden" name="total_price" id="input-total-price" value="">

              <div class="tab-content" id="bookingTabContent">
                <!-- Step 1: Traveler Information -->
                <div class="form-step tab-pane fade show active" id="travel-booking-step-1" role="tabpanel">
                  <h4>Traveler Information</h4>

                  <div class="traveler-info">
                    <h5>Lead Traveler</h5>
                    <div class="row gy-3">
                      <div class="col-md-6">
                        <label for="first-name">First Name *</label>
                        <input type="text" name="first_name" id="first-name" class="form-control" required
                          value="<?= htmlspecialchars($_SESSION['user']['first_name'] ?? '') ?>">
                      </div>
                      <div class="col-md-6">
                        <label for="last-name">Last Name *</label>
                        <input type="text" name="last_name" id="last-name" class="form-control" required
                          value="<?= htmlspecialchars($_SESSION['user']['last_name'] ?? '') ?>">
                      </div>

                      <div class="col-md-6">
                        <label for="email">Email Address *</label>
                        <input type="email" name="email" id="email" class="form-control" required readonly
                          value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>">
                      </div>
                      <div class="col-md-6">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" name="phone" id="phone" class="form-control" required readonly
                          value="<?= htmlspecialchars($_SESSION['user']['phone'] ?? '') ?>">
                      </div>
                      <div class="col-md-6">
                        <label for="additional-phone">Additional Phone</label>
                        <input type="tel" name="additional_phone" id="additional-phone" class="form-control" placeholder="Optional">
                      </div>

                      <div class="col-md-12">
                        <label for="address">Address *</label>
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
                        <label for="nationality">Nationality *</label>
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
                <div class="form-step tab-pane fade" id="travel-booking-step
                  <h4>Enhance Your Experience <span style=" color:gray;">(Coming Soon)</span></h4>


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
                          <span class="price">$</span>
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
                          <span class="price">$</span>
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
                          <span class="price">$</span>
                          <span class="period">per night</span>
                        </div>
                      </div>
                    </div>

                    <div class="addon-item">
                      <div class="addon-details">
                        <div class="addon-check">
                          <input type="checkbox" name="local_guide" disabled id="local-guide" value="yes">
                          <label for="local-guide">
                            <h5>Private Local Guide</h5>
                            <p>Personal guide for exclusive insights and customized exploration of hidden gems.</p>
                          </label>
                        </div>
                        <div class="addon-price">
                          <span class="price">$</span>
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
                    <?php
                    // Database connection (ensure this is already included earlier)
                    require '../config/db.php'; // Update path as needed

                    $stmt = $mysqli->prepare("SELECT id, method_name FROM pay_method");
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $first = true;
                    while ($row = $result->fetch_assoc()):
                      $id = $row['id'];
                      $name = htmlspecialchars($row['method_name']);
                      $value = strtolower(str_replace(' ', '_', $name));
                    ?>
                      <div class="method-selector">
                        <input type="radio" name="payment_method" id="payment-<?= $value ?>" value="<?= $id ?>" <?= $first ? 'checked' : '' ?>>
                        <label for="payment-<?= $value ?>">
                          <i class="bi bi-credit-card"></i> <?= $name ?>
                        </label>
                      </div>
                    <?php
                      $first = false;
                    endwhile;
                    ?>
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
                </div><!-- End Step 3 -->

              </div><!-- End Tab Content -->

            </form><!-- End Booking Form -->
          </div>
        </div>
        <!-- Booking Summary Sidebar -->
        <div class="col-lg-4">
          <div class="booking-summary" id="booking-summary" data-aos="fade-up" data-aos-delay="400">
            <div class="summary-header">
              <h4>Booking Summary</h4>
            </div>

            <div class="selected-tour">
              <img src="../assets/img/Angkorwat/delt.jpg" alt="Selected Tour" class="img-fluid">
              <?php if ($tourInfo): ?>
                <div class="full-tour-info mt-3">
                  <p><strong>Tour Name:</strong> <?= htmlspecialchars($tourInfo['tour_name']) ?></p>
                  <p><strong>Destinations:</strong> <?= nl2br(htmlspecialchars($tourInfo['destinations'])) ?></p>
                  <p><strong>Duration:</strong> <?= htmlspecialchars($tourInfo['durations']) ?> days</p>
                  <p><strong>Group Size:</strong> <span id="summary-top-group-size">-</span></p>
                  <!-- <p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($tourInfo['description'])) ?></p> -->
                  <p><strong>Price Starts At:</strong> $<?= number_format($tourInfo['price_start'], 2) ?></p>
                </div>
              <?php else: ?>
                <p>No tour information found.</p>
              <?php endif; ?>
            </div>

            <div class="booking-details mt-3">
              <div class="detail-item"><span class="label">Start Tour:</span><span class="value" id="summary-departure">-</span></div>
              <div class="detail-item"><span class="label">Travelers:</span><span class="value" id="summary-travelers">-</span></div>
              <div class="detail-item"><span class="label">Duration:</span><span class="value" id="summary-duration"><?= $tourInfo ? htmlspecialchars($tourInfo['durations']) . ' days' : '-' ?></span></div>
              <!-- <div class="detail-item"><span class="label">Flight:</span><span class="value" id="summary-flight">Included</span></div> -->
              <div class="detail-item">
                <span class="label">Group Size:</span>
                <span class="value" id="summary-group-size">-</span>
              </div>
              <div class="detail-item"><span class="label">Adults:</span><span class="value" id="summary-adults">0</span></div>
              <div class="detail-item"><span class="label">Child (12+):</span><span class="value" id="summary-child12">0</span></div>
              <div class="detail-item"><span class="label">Child (5–11) with bed:</span><span class="value" id="summary-child75">0</span></div>
              <div class="detail-item"><span class="label">Child (5–11) no bed:</span><span class="value" id="summary-child50">0</span></div>
              <div class="detail-item"><span class="label">Child (under 5):</span><span class="value" id="summary-child0">0</span></div>
            </div>

            <div class="price-breakdown mt-3">
              <div class="price-item base-price">
                <span class="description">Base Price</span>
                <span class="amount" id="base-price-amount">$<?= $tourInfo ? number_format($tourInfo['price_start'], 2) : '0.00' ?></span>
              </div>
              <div class="price-total">
                <span class="description">Total Amount</span>
                <span class="amount" id="total-price-amount">$0.00</span>
              </div>
            </div>

            <div class="help-section mt-3">
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


<!-- Cancellation Policy Modal -->
<div class="modal fade" id="cancellationPolicyModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content p-4 shadow rounded-4 border-0">
      <div class="modal-body">
        <div class="text-center mb-4">
          <div class="text-warning" style="font-size: 3rem;">
            <i class="bi bi-exclamation-circle-fill"></i>
          </div>
          <h4 class="fw-bold mt-2">Cancellation Policy</h4>
          <p class="text-muted small">Please read this important information before proceeding.</p>
        </div>

        <hr class="mb-3">

        <div class="policy-content" style="max-height: 350px; overflow-y: auto; font-size: 0.95rem; line-height: 1.6;">
          <strong class="text-dark">CANCELLATION OF TOUR <span class="text-muted">(Not applicable for Tet holiday)</span></strong><br><br>
          <ul class="mb-3">
            <li>Before 14 days: <strong>10%</strong> of tour price</li>
            <li>From 7–14 days: <strong>50%</strong> of tour price</li>
            <li>From 0–7 days: <strong>100%</strong> of tour price</li>
          </ul>

          <strong class="text-dark">NOTE</strong><br>
          <ul class="mb-0">
            <li>Original passport valid for at least 6 months upon return date.</li>
            <li>Visa exemption for nationals of Malaysia, Laos, Philippines, Singapore, and Vietnam.</li>
            <li>Overseas Vietnamese or foreigners using a separate visa must bring the original visa.</li>
            <li>If you hold two nationalities or travel documents, inform tour staff and submit originals.</li>
            <li>Green card holders without a Vietnamese passport cannot register the tour.</li>
            <li><strong>50% deposit</strong> required at registration. Full payment due 7 days before the tour.</li>
            <li>Guests aged over 70 must submit a health commitment form. The company holds no responsibility for health incidents.</li>
            <li>No refunds if you are denied exit/entry due to personal reasons.</li>
            <li>Programs and hotels may change, but total attractions are guaranteed.</li>
          </ul>
        </div>

        <div class="text-center mt-4">
          <button type="button" class="btn btn-primary px-4 py-2" data-bs-dismiss="modal">
            I Understand
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Show modal when checkbox is checked -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const checkbox = document.getElementById("terms-agreement");
    if (checkbox) {
      checkbox.addEventListener("click", function() {
        if (checkbox.checked) {
          const modal = new bootstrap.Modal(document.getElementById("cancellationPolicyModal"));
          modal.show();
        }
      });
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