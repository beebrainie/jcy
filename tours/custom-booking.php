<?php
session_start();

if (!isset($_SESSION['user'])) {
  header("Location: signup.php");
  exit;
}

include '../partials/__head.php';
include '../partials/__subhero.php';

$user = $_SESSION['user'];
$userJson = json_encode([
  'first_name' => $user['first_name'] ?? '',
  'last_name' => $user['last_name'] ?? '',
  'email' => $user['email'] ?? '',
  'phone' => $user['phone'] ?? '',
  // You can add more if stored in session
]);
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
            <form action="submit-custom-booking.php" method="post" class="booking-form" data-aos="fade-up" data-aos-delay="300">
              <input type="hidden" name="custom_tour_info_json" id="custom_tour_info_json">

              <div class="tab-content" id="bookingTabContent">

                <!-- Step 1: Traveler Information -->
                <div class="form-step tab-pane fade show active" id="travel-booking-step-1" role="tabpanel">
                  <h4>Traveler Information</h4>

                  <div class="traveler-info">
                    <h5>Lead Traveler</h5>
                    <div class="row gy-3">
                      <!-- Default fields unchanged -->
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
                        <!-- <input type="email" name="email" id="email" class="form-control" required> -->
                        <input type="email" name="email" id="email" class="form-control" required readonly>
                      </div>
                      <div class="col-md-6">
                        <label for="phone">Phone Number</label>
                        <!-- <input type="tel" name="phone" id="phone" class="form-control" required> -->
                        <input type="tel" name="phone" id="phone" class="form-control" required readonly>

                      </div>

                      <!-- Additional fields based on customers table -->
                      <div class="col-md-6">
                        <label for="additional-phone">Additional Phone</label>
                        <input type="tel" name="additional_phone" id="additional-phone" class="form-control" placeholder="Optional">
                      </div>

                      <div class="col-md-12">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                      </div>

                      <div class="col-md-6">
                        <label for="street-no">Street No</label>
                        <input type="text" name="street_no" id="street-no" class="form-control" placeholder="Optional">
                      </div>
                      <div class="col-md-6">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" class="form-control" placeholder="Optional">
                      </div>

                      <div class="col-md-6">
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country" class="form-control" placeholder="Optional">
                      </div>
                      <div class="col-md-6">
                        <label for="zip">ZIP / Postal Code</label>
                        <input type="text" name="zip" id="zip" class="form-control" placeholder="Optional">
                      </div>

                      <div class="col-md-6">
                        <label for="passport-number">Passport Number</label>
                        <input type="text" name="passport_number" id="passport-number" class="form-control" placeholder="Optional">
                      </div>
                      <div class="col-md-6">
                        <label for="fly-number">Flight Number</label>
                        <input type="text" name="fly_number" id="fly-number" class="form-control" placeholder="Optional">
                      </div>

                      <div class="col-md-6">
                        <label for="nationality">Nationality</label>
                        <input type="text" name="nationality" id="nationality" class="form-control" required>
                      </div>
                    </div>
                  </div>

                  <!-- Special Request Block remains unchanged -->
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

                  <div class="terms-agreement">
                    <h5>Visa & Permit </h5>
                    <div class="form-check">
                      <input type="checkbox" name="visa_permit" id="visa-permit" class="form-check-input" value="Yes">


                      <label for="visa-permit" class="form-check-label">
                        Yes, please help check manage the VISA and Permit for me.
                      </label>
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
                          <!-- <input type="checkbox" name="travel_insurance" id="travel-insurance" value="yes"> -->
                          <input type="checkbox" name="add_on[]" id="travel-insurance" value="Travel Insurance">
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
                          <!-- <input type="checkbox" name="airport_transfer" id="airport-transfer" value="yes"> -->
                          <input type="checkbox" name="add_on[]" id="airport-transfer" value="Airport Transfer">
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
                          <!-- <input type="checkbox" name="extra_nights" id="extra-nights" value="yes"> -->
                          <input type="checkbox" name="add_on[]" id="extra-nights" value="Extra Hotel Nights">
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
                          <!-- <input type="checkbox" name="local_guide" id="local-guide" value="yes"> -->
                          <input type="checkbox" name="add_on[]" id="local-guide" value="Private Local Guide">
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
          <div class="booking-summary" data-aos="fade-up" data-aos-delay="400">
            <div class="summary-header">
              <h4>Booking Summary</h4>
            </div>

            <div class="selected-tour">
              <img src="../assets/img/Angkorwat/angk.jpg" alt="Selected Tour" class="img-fluid" style="max-height: 180px; object-fit: cover; width: 100%;">
              <div class="tour-info">
                <h5 id="summary-tour-title">Your Custom Tour</h5>
                <p><i class="bi bi-calendar"></i> <span id="summary-trip-length">-- Days</span></p>
                <p><i class="bi bi-geo-alt"></i> <span id="summary-destinations">--</span></p>
              </div>
            </div>

            <div class="booking-details">
              <div class="detail-item">
                <span class="label">Departure:</span>
                <span class="value" id="summary-departure-date">--</span>
              </div>
              <div class="detail-item">
                <span class="label">Travelers:</span>
                <span class="value" id="summary-travelers">--</span>
              </div>
              <div class="detail-item">
                <span class="label">Hotel Rooms:</span>
                <span class="value" id="summary-hotel-rooms">--</span>
              </div>
              <div class="detail-item">
                <span class="label">Duration:</span>
                <span class="value" id="summary-duration">--</span>
              </div>
              <div class="detail-item">
                <span class="label">Budget Per Person:</span>
                <span class="value" id="summary-budget">-- USD</span>
              </div>
              <div class="detail-item">
                <span class="label">International Flight Offer:</span>
                <span class="value" id="summary-flight-offer">--</span>
              </div>
            </div>

            <!-- Price breakdown example (you can customize how you calculate or show these) -->
            <div class="price-breakdown">
              <div class="price-item">
                <span class="description">Base Price (per person)</span>
                <span class="amount" id="price-base">$0</span>
              </div>
              <!-- Add more price items if you have them -->
              <div class="price-total">
                <span class="description">Total Amount</span>
                <span class="amount" id="price-total">$0</span>
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

        <script>
          document.addEventListener("DOMContentLoaded", () => {
            const tourInfoJSON = localStorage.getItem('custom_tour_info');
            if (!tourInfoJSON) return; // no data to show

            const tourInfo = JSON.parse(tourInfoJSON);

            // Destinations as comma-separated string
            const destinations = tourInfo.destinations ? tourInfo.destinations.join(', ') : 'Not selected';

            // Travelers counts
            const adults = tourInfo.travelers_adults || 0;
            const children = tourInfo.travelers_children || 0;
            const totalTravelers = adults + children;

            // Budget per person formatted
            const budget = tourInfo.budget_per_person ? tourInfo.budget_per_person.toLocaleString() : '--';

            // Flight offer
            const flightOffer = tourInfo.international_flight === 'Yes' ? 'Yes' : 'No';

            // Trip days
            const tripDays = tourInfo.trip_days || '--';

            // Travel date in readable format (optional, format YYYY-MM-DD to DD/MM/YYYY)
            const travelDateRaw = tourInfo.travel_date || '';
            let travelDateFormatted = '--';
            if (travelDateRaw) {
              const parts = travelDateRaw.split('-'); // ["2025", "07", "28"]
              if (parts.length === 3) {
                travelDateFormatted = parts[2] + '/' + parts[1] + '/' + parts[0];
              } else {
                travelDateFormatted = travelDateRaw;
              }
            }

            // Hotel rooms
            const hotelRooms = tourInfo.hotel_rooms || '--';

            // Update DOM elements
            document.getElementById('summary-destinations').textContent = destinations;
            document.getElementById('summary-trip-length').textContent = `${tripDays} Days`;
            document.getElementById('summary-departure-date').textContent = travelDateFormatted;
            document.getElementById('summary-travelers').textContent = `${totalTravelers} traveler${totalTravelers !== 1 ? 's' : ''} (${adults} adults, ${children} children)`;
            document.getElementById('summary-hotel-rooms').textContent = hotelRooms;
            document.getElementById('summary-duration').textContent = `${tripDays} Days`;
            document.getElementById('summary-budget').textContent = `${budget} USD`;
            document.getElementById('summary-flight-offer').textContent = flightOffer;

            // If you have an image URL stored in tourInfo, use it, else default image
            if (tourInfo.image_url) {
              document.getElementById('summary-tour-image').src = tourInfo.image_url;
            } else {
              document.getElementById('summary-tour-image').src = 'assets/img/travel/tour-15.webp';
            }

            // Price calculation (example: base price = budget * total travelers)
            // Adjust or get from your backend/pricing logic
            const basePrice = budget !== '--' ? budget * totalTravelers : 0;
            document.getElementById('price-base').textContent = `$${basePrice.toLocaleString()}`;

            // Total price (example, you can add add-ons and taxes here)
            // For now just base price
            document.getElementById('price-total').textContent = `$${basePrice.toLocaleString()}`;
          });
        </script>

      </div>
    </div>

  </section>
  <!-- /Travel Booking Section -->
</main>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    // User info from PHP session
    const user = <?php echo $userJson; ?>;

    // Fill basic inputs
    if (user) {
      if (user.first_name) document.getElementById('first-name').value = user.first_name;
      if (user.last_name) document.getElementById('last-name').value = user.last_name;
      if (user.email) document.getElementById('email').value = user.email;
      if (user.phone) document.getElementById('phone').value = user.phone;
    }

    // Optionally, prefill other fields if you store them in session or localStorage

    // Also, if you have tour info stored in localStorage (like custom_tour_info), you can load & display it too
    const tourInfo = JSON.parse(localStorage.getItem('custom_tour_info'));
    if (tourInfo) {
      console.log('Tour info:', tourInfo);
      // You can update booking summary, inputs, etc. here if needed
      // For example, update some summary fields:
      // document.querySelector('.selected-tour h5').textContent = tourInfo.tourName || 'Your Tour';
    }
  });
</script>

<script>
  const tourInfo = JSON.parse(localStorage.getItem('custom_tour_info'));
  console.log(tourInfo);
</script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector('.booking-form');
    const hiddenInput = document.getElementById('custom_tour_info_json');

    form.addEventListener('submit', function(e) {
      const tourInfo = localStorage.getItem('custom_tour_info');
      if (!tourInfo) {
        alert("Tour information is missing. Please customize your tour first.");
        e.preventDefault(); // Stop form from submitting
        return;
      }
      hiddenInput.value = tourInfo;
    });
  });
</script>

<style>
  .step.disabled {
    pointer-events: none;
    opacity: 0.5;
    cursor: not-allowed;
  }
</style>


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
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>
<script src="../assets/vendor/aos/aos.js"></script>
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="../assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>

<!-- Main JS File -->
<script src="../assets/js/main.js"></script>

</body>

</html>