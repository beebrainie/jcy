<?php
include 'partials/_head.php';
include 'partials/_subhero.php';
?>

<main class="main">


  <!-- Faq Section -->
  <section id="faq" class="faq section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row align-items-start gy-4">
        <div class="col-lg-5" data-aos="fade-up" data-aos-delay="200">
          <div class="faq-sidebar">
            <div class="faq-image">
              <img src="assets/img/illustration/illustration-5.webp" alt="FAQ Image" class="img-fluid" loading="lazy">
            </div>
            <div class="contact-box">
              <h3><i class="bi bi-headset"></i> Need Assistance?</h3>
              <p>Have questions about your tour or booking? Our team is here to help you every step of the way.</p>
              <a href="contact.php" class="btn-contact">Connect with Support</a>
            </div>

          </div>
        </div>

        <div class="col-lg-7">
          <div class="faq-tabs">
            <ul class="nav nav-pills mb-4" id="faqTabs-faq" role="tablist" data-aos="fade-up" data-aos-delay="100">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="general-tab-faq" data-bs-toggle="pill" data-bs-target="#general-faq-faq" type="button" role="tab" aria-controls="general-faq-faq" aria-selected="true">General Questions</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="account-tab-faq" data-bs-toggle="pill" data-bs-target="#account-faq-faq" type="button" role="tab" aria-controls="account-faq-faq" aria-selected="false">Booking</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="payment-tab-faq" data-bs-toggle="pill" data-bs-target="#payment-faq-faq" type="button" role="tab" aria-controls="payment-faq-faq" aria-selected="false">Payments & Refunds</button>
              </li>
            </ul>

            <div class="tab-content" id="faqTabsContent-faq">
              <div class="tab-pane fade show active" id="general-faq-faq" role="tabpanel" aria-labelledby="general-tab-faq">
                <div class="accordion" id="generalAccordion-faq">
                  <div class="faq-item" data-aos="fade-up" data-aos-delay="150">
                    <h3>What makes JCY tours different?</h3>
                    <div class="faq-content">
                      <p>We craft soulful, off-the-beaten-path experiences that reveal the real Cambodia - not just the tourist trail.</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->


                  <div class="faq-item" data-aos="fade-up" data-aos-delay="250">
                    <h3>Do you handle everything, or just the tours?</h3>
                    <div class="faq-content">
                      <p>Everything. Flights, hotels, visas, insurance, local guides, SIM cards, we’re your all-in-one travel fixers.</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                    <h3>Is JCY a trusted company?</h3>
                    <div class="faq-content">
                      <p>100%. We’re fully licensed by Cambodia’s Ministry of Tourism and backed by over a decade of trusted service.</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="350">
                    <h3>I’m traveling solo, is that safe?</h3>
                    <div class="faq-content">
                      <p>Totally! We specialize in solo and small group travel, with 24/7 support and local connections throughout your trip.</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                    <h3> What languages do your guides speak?</h3>
                    <div class="faq-content">
                      <p>Our professional guides speak English, Khmer, Chinese, and other languages upon request</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->
                </div>
              </div>

              <div class="tab-pane fade" id="account-faq-faq" role="tabpanel" aria-labelledby="account-tab-faq">
                <div class="accordion" id="accountAccordion-faq">
                  <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                    <h3> Can I book last-minute?</h3>
                    <div class="faq-content">
                      <p>100%. We’re fully licensed by Cambodia’s Ministry of Tourism and backed by over a decade of trusted service.</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                    <h3>Can I create my own custom tour?</h3>
                    <div class="faq-content">
                      <p>Yes! Just tell us your vibe romantic, adventurous, spiritual and we’ll build your dream itinerary.</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                    <h3>What payment methods do you accept?</h3>
                    <div class="faq-content">
                      <p>We accept credit cards, bank transfers, and cash upon arrival. Secure online payment options are also available for international travelers.</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="350">
                    <h3>Is my booking confirmed instantly?</h3>
                    <div class="faq-content">
                      <p>Standard bookings are confirmed instantly via email/Telegram For custom itineraries, our team will review your request and confirm within 24 hours.</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="450">
                    <h3>Can I change my travel dates after booking?</h3>
                    <div class="faq-content">
                      <p>Yes, we’re flexible! Contact us at least 3 days in advance and we’ll do our best to adjust your travel dates at no extra cost.</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->

                </div>
              </div>

              <div class="tab-pane fade" id="payment-faq-faq" role="tabpanel" aria-labelledby="payment-tab-faq">
                <div class="accordion" id="paymentAccordion-faq">
                  <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                    <h3>What is your payment policy?</h3>
                    <div class="faq-content">
                      <p>We require a 50% deposit upon tour confirmation. The remaining balance must be paid in full at least 10 days prior to your arrival date.</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="250">
                    <h3>What happens if I need to cancel my booking?</h3>
                    <div class="faq-content">
                      <p>You can cancel up to 21 days before your arrival for a full refund. If you cancel within 7 days, 50% of your deposit will be charged. Cancellations made less than 7 days before arrival will be charged 100% of the total cost.</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                    <h3>Can I change the travel date after cancellation?</h3>
                    <div class="faq-content">
                      <p>Unfortunately, once a booking is cancelled or marked as a no-show, the travel date cannot be amended or rescheduled.</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="350">
                    <h3>Are there any blackout dates or peak season exclusions?</h3>
                    <div class="faq-content">
                      <p>Yes, the listed prices do not apply during long public holidays and peak travel seasons such as Chinese New Year (Feb 11–19), Khmer New Year (Apr 13–16), Pchum Ben (Sep 20–23), Water Festival (Nov 3–6), and New Year Eve (Dec 24–31).</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                    <h3>Do you provide refunds for unexpected events or disasters?</h3>
                    <div class="faq-content">
                      <p>While we aim to maintain high service quality, we are not liable for refunds due to natural disasters, transport disruptions, or safety concerns. We also cannot refund in cases of visa denial or personal travel restrictions.</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                    <h3>How are children charged in the booking?</h3>
                    <div class="faq-content">
                      <p>Children under 5 years old – Free of charge <br>
                        Children aged 5–11 (without bed) – 50% of adult price <br>
                        Children aged 5–11 (with own bed) – 75% of adult price <br>
                        Children 12 and above – Charged as adults (100%)</p>
                    </div>
                    <i class="bi bi-chevron-down faq-toggle"></i>
                  </div><!-- End FAQ Item-->

                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </section><!-- /Faq Section -->

</main>

<?php include 'partials/_footer.php' ?>
<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>