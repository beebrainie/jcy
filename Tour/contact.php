<?php
include 'partials/_head.php';
include 'partials/_subhero.php';
?>

<main class="main">

  <!-- Contact Section -->
  <section id="contact" class="contact section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <!-- Contact Info Boxes -->
      <div class="row gy-4 mb-5">
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="contact-info-box">
            <div class="icon-box">
              <i class="bi bi-geo-alt"></i>
            </div>
            <div class="info-content">
              <h4>Our Address</h4>
              <p><a href="https://www.google.com/maps/place/JCY+Tour+%26+Travel+Co.,+Ltd./@10.8424971,105.9268973,17z/data=!3m1!4b1!4m6!3m5!1s0x310afdd5823d40c1:0x40773658efed9627!8m2!3d10.8424918!4d105.9294722!16s%2Fg%2F11jv07rfl8?entry=ttu&g_ep=EgoyMDI1MDcxNi4wIKXMDSoASAFQAw%3D%3D">Prey Vor-Moc Hoa Border, Au Village, Thmei Commune, Kampong Rou District, Svay Rieng Province, Cambodia.</a></p>
            </div>
          </div>
        </div>

        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
          <div class="contact-info-box">
            <div class="icon-box">
              <i class="bi bi-envelope"></i>
            </div>
            <div class="info-content">
              <h4>Email Address</h4>
              <p>sales@jcytour.com</p>
              <p>(+855) 97 559 0178</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
          <div class="contact-info-box">
            <div class="icon-box">
              <i class="bi bi-headset"></i>
            </div>
            <div class="info-content">
              <h4>Hours of Operation</h4>
              <p>Monday – Friday: 8am – 6pm</p>
              <p>Saturday: 8am – 12pm</p>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Google Maps (Full Width) -->
    <div class="map-section" data-aos="fade-up" data-aos-delay="200">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.5920728270694!2d105.92689727497967!3d10.842497057971704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310afdd5823d40c1%3A0x40773658efed9627!2sJCY%20Tour%20%26%20Travel%20Co.%2C%20Ltd.!5e0!3m2!1sen!2skh!4v1753167012735!5m2!1sen!2skh" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <!-- Contact Form Section (Overlapping) -->
    <div class="container form-container-overlap">
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="300">
        <div class="col-lg-10">
          <div class="contact-form-wrapper">
            <h2 class="text-center mb-4">Get in Touch</h2>

            <form id="contactFormUnique" class="php-email-form">
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-with-icon">
                      <i class="bi bi-person"></i>
                      <input type="text" id="name" name="name" class="form-control" placeholder="First Name" required />
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-with-icon">
                      <i class="bi bi-envelope"></i>
                      <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required />
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <div class="input-with-icon">
                      <i class="bi bi-text-left"></i>
                      <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" required />
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <div class="input-with-icon">
                      <i class="bi bi-chat-dots message-icon"></i>
                      <textarea id="message" name="message" class="form-control" placeholder="Write Message..." style="height: 180px" required></textarea>
                      <div class="invalid-feedback"></div>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div id="successMessage" class="alert alert-success" style="display: none;">✅ Your message has been sent. Thank you!</div>
                </div>

                <div class="col-12 text-center">
                  <button type="button" id="submitContactForm" class="btn btn-primary btn-submit">SEND MESSAGE</button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>

    </div>

  </section><!-- /Contact Section -->

</main>

<?php include 'partials/_footer.php'; ?>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="forms/contact.js" defer></script>
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