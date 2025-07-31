<?php
include 'partials/_head.php';
include 'partials/_hero.php';
require_once 'config/db.php';
?>

<main class="main">
  <!-- Why Us Section -->
  <section id="why-us" class="why-us section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <!-- About Us Content -->
      <div class="row align-items-center mb-5">
        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
          <div class="content">
            <h3>Discover the World with JCYTour</h3>
            <p>At JCYTour, we turn your travel dreams into reality. Whether you're seeking adventure, culture, or relaxation, our
              expert team ensures every journey is seamless, safe, and unforgettable.</p>
            <p>Travel with confidence knowing you're backed by a trusted company committed to quality service, personalized
              experiences, and unforgettable memories. Your next great escape starts here with JCYTour.</p>

            <div class="stats-row">
              <div class="stat-item">
                <span data-purecounter-start="0" data-purecounter-end="1200" data-purecounter-duration="2" class="purecounter">0</span>
                <div class="stat-label">Happy Travelers</div>
              </div>
              <div class="stat-item">
                <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="2" class="purecounter">0</span>
                <div class="stat-label">Countries Covered</div>
              </div>
              <div class="stat-item">
                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="2" class="purecounter">0</span>
                <div class="stat-label">Years Experience</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
          <div class="about-image">
            <img src="assets/img/travel/showcase-8.webp" alt="Travel Experience" class="img-fluid rounded-4">
            <div class="experience-badge">
              <div class="experience-number">15+</div>
              <div class="experience-text">Years of Excellence</div>
            </div>
          </div>
        </div>
      </div><!-- End About Us Content -->

      <!-- Why Choose Us -->
      <div class="why-choose-section">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center mb-5" data-aos="fade-up" data-aos-delay="100">
            <h3>Why Choose Us for Your Next Adventure</h3>
            <p>Our passionate local guides bring unmatched knowledge, insider access, and cultural depth to every step of your trip.</p>
          </div>
        </div>

        <div class="row g-4">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="bi bi-people-fill"></i>
              </div>
              <h4>Local Experts</h4>
              <p>Our passionate local guides bring unmatched knowledge, insider access, and cultural depth to every step of your trip.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="bi bi-shield-check"></i>
              </div>
              <h4>Safe &amp; Secure</h4>
              <p>Your safety is our top priority. We partner only with trusted operators and follow strict safety standards for worry-free travel.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="bi bi-cash"></i>
              </div>
              <h4>Best Prices</h4>
              <p>Enjoy premium travel experiences at competitive rates, with no hidden fees—just exceptional value every time.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="bi bi-headset"></i>
              </div>
              <h4>24/7 Support</h4>
              <p>Whether it's day or night, our dedicated support team is always ready to assist you before, during, and after your journey.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="bi bi-geo-alt-fill"></i>
              </div>
              <h4>Global Destinations</h4>
              <p>Explore breathtaking destinations near and far with curated itineraries that suit your interests and travel style.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="450">
            <div class="feature-card">
              <div class="feature-icon">
                <i class="bi bi-star-fill"></i>
              </div>
              <h4>Premium Experience</h4>
              <p>From handpicked accommodations to seamless logistics, we ensure a first-class experience from start to finish.</p>

            </div>
          </div>
        </div><!-- End Features Grid -->
      </div><!-- End Why Choose Us -->

    </div>

  </section><!-- /Why Us Section -->

  <!-- Featured Destinations Section -->
  <section id="featured-destinations" class="featured-destinations section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Featured Destinations</h2>
      <div><span>Check Our</span> <span class="description-title">Featured Destinations</span></div>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row">

        <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
          <div class="featured-destination">
            <div class="destination-overlay">
              <img src="assets/img/Angkorwat/angkor01.jpg" alt="Tropical Paradise" class="img-fluid">
              <div class="destination-info">
                <span class="destination-tag">Popular Choice</span>
                <h3>Angkor Wat</h3>
                <p class="location"><i class="bi bi-geo-alt-fill"></i> Siem Reap <span class="text-warning">. Cambodia</span></p>
                <p class="description">Step back in time at Angkor Wat, the world’s largest religious monument. Nestled in the heart of
                  Siem Reap, this ancient temple complex showcases Cambodia’s rich history, breathtaking architecture, and spiritual
                  heritage.</p>

                <div class="destination-meta">
                  <div class="tours-count">
                    <i class="bi bi-collection"></i>
                    <span>22 Packages</span>
                  </div>
                  <div class="rating">
                    <i class="bi bi-star-fill"></i>
                    <span>4.9 (412)</span>
                  </div>
                </div>
                <div class="price-info">
                  <span class="starting-from">Starting from</span>
                  <span class="amount">$2,150</span>
                </div>
                <a href="tours/Angkor-Wat-Grand-Circuit-Jungle-Temple.php" class="explore-btn">
                  <span>Explore Now</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="row g-3">

            <div class="col-12" data-aos="fade-left" data-aos-delay="300">
              <div class="compact-destination">
                <div class="destination-image">
                  <img src="assets/img/sea/Koh Kong.jpg" alt="Mountain Adventure" class="img-fluid">
                  <div class="badge-offer">Best Value</div>
                </div>
                <div class="destination-details">
                  <h4>Koh Rong Island</h4>
                  <p class="location"><i class="bi bi-geo-alt-fill"></i> Koh Rong, <span class="text-warning">Cambodia</span></p>
                  <p class="brief">Escape to the pristine shores of Koh Rong Island, where white-sand beaches, turquoise waters, and
                    laid-back island vibes create the perfect tropical getaway.</p>

                  <div class="stats-row">
                    <span class="tour-count"><i class="bi bi-calendar-check"></i> 16 Tours</span>
                    <span class="rating"><i class="bi bi-star-fill"></i> 4.8</span>
                    <span class="price">from $1,420</span>
                  </div>
                  <a href="tours/Phnom-Penh-Koh-Rong-Island.php" class="quick-link">View Details <i class="bi bi-chevron-right"></i></a>
                </div>
              </div>
            </div>

            <div class="col-12" data-aos="fade-left" data-aos-delay="400">
              <div class="compact-destination">
                <div class="destination-image">
                  <img src="assets/img/City/inc.jpg" alt="Cultural Heritage" class="img-fluid">
                </div>
                <div class="destination-details">
                  <h4>Phnom Penh City</h4>
                  <p class="location"><i class="bi bi-geo-alt-fill"></i> Phnom Penh, <span class="text-warning">Cambodia</span></p>
                  <p class="brief">Experience the vibrant capital of Cambodia—where colonial architecture, riverside charm, royal palaces,
                    and a deep history come together in a dynamic urban setting.</p>

                  <div class="stats-row">
                    <span class="tour-count"><i class="bi bi-calendar-check"></i> 9 Expeditions</span>
                    <span class="rating"><i class="bi bi-star-fill"></i> 4.7</span>
                    <span class="price">from $980</span>
                  </div>
                  <a href="tours/Depart-from-Prey-Vor-Bavet-Borders-Phnom-Penh.php" class="quick-link">View Details <i class="bi bi-chevron-right"></i></a>
                </div>
              </div>
            </div>

            <div class="col-12" data-aos="fade-left" data-aos-delay="500">
              <div class="compact-destination">
                <div class="destination-image">
                  <img src="assets/img/royalpalace/7c.jpg" alt="Safari Experience" class="img-fluid">
                  <div class="badge-offer limited">Limited Spots</div>
                </div>
                <div class="destination-details">
                  <h4>Royal Palace Experience</h4>
                  <p class="location"><i class="bi bi-geo-alt-fill"></i> Phnom Penh, <span class="text-warning">Cambodia</span></p>
                  <p class="brief">Step into the grandeur of Cambodia’s Royal Palace in Phnom Penh—admire its golden spires, tranquil
                    gardens, and the sacred Silver Pagoda, a symbol of the nation’s royal heritage.</p>

                  <div class="stats-row">
                    <span class="tour-count"><i class="bi bi-calendar-check"></i> 11 Safaris</span>
                    <span class="rating"><i class="bi bi-star-fill"></i> 4.9</span>
                    <span class="price">from $2,750</span>
                  </div>
                  <a href="tours/Phnom-Penh-Casino.php" class="quick-link">View Details <i class="bi bi-chevron-right"></i></a>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

    </div>

  </section><!-- /Featured Destinations Section -->

  <!-- Featured Tours Section -->
  <?php
  $sql = "SELECT * FROM package_tours ORDER BY id DESC LIMIT 6";
  $result = $mysqli->query($sql);

  // Predefined image list (repeat or extend as needed)
  $tourImages = [
    'assets/img/Angkorwat/angk.jpg',
    'assets/img/Bayon Temple,/ancient-khmer-architecture-amazing-view-bayon-temple-sunset-angkor-wat-complex_558469-4830.avif',
    'assets/img/Baphuon/HA5D5069.jpg',
    'assets/img/royalpalace/royal-palace-1920x1200.jpg',
    'assets/img/sea/kohrongs.jpg',
    'assets/img/Angkorwat/angkor01.jpg',
  ];
  $imageIndex = 0;

  function slugify($text)
  {
    // lowercase
    $text = strtolower($text);
    // replace non-alphanumeric with dashes
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    // trim dashes from ends
    $text = trim($text, '-');
    return $text;
  }
  ?>

  <section id="featured-tours" class="featured-tours section">

    <div class="container section-title" data-aos="fade-up">
      <h2>Featured Tours</h2>
      <div><span>Check Our</span> <span class="description-title">Featured Tours</span></div>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4">
        <?php while ($row = $result->fetch_assoc()): ?>
          <?php
          // Fallback if more rows than images
          $imagePath = $tourImages[$imageIndex] ?? 'assets/img/travel/default.webp';
          $imageIndex++;

          $slug = slugify($row['tour_name']);
          ?>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="tour-card">
              <div class="tour-image">
                <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($row['tour_name']) ?>" class="img-fluid" loading="lazy">
                <div class="tour-badge">Featured</div>
                <div class="tour-price">$<?= number_format($row['price_start'], 2) ?></div>
              </div>
              <div class="tour-content">
                <h4><?= htmlspecialchars($row['tour_name']) ?></h4>
                <div class="tour-meta">
                  <span class="duration"><i class="bi bi-clock"></i> <?= (int)$row['durations'] ?> Days</span>
                  <span class="group-size"><i class="bi bi-people"></i> Max <?= (int)$row['max_people'] ?></span>
                </div>
                <p><?= nl2br(substr(strip_tags($row['description']), 0, 100)) ?>...</p>

                <div class="tour-highlights">
                  <?php
                  $places = array_filter(array_map('trim', explode(',', $row['destinations'])));
                  foreach (array_slice($places, 0, 3) as $place):
                  ?>
                    <span><?= htmlspecialchars($place) ?></span>
                  <?php endforeach; ?>
                </div>
                <div class="tour-action">
                  <!-- Link to tours/{slug}.php -->
                  <a href="tours/<?= urlencode($slug) ?>.php" class="btn-book">Book Now</a>
                  <div class="tour-rating">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-half"></i>
                    <span>4.8</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

      <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="500">
        <a href="tours.php" class="btn-view-all">View All Tours</a>
      </div>

    </div>
  </section><!-- /Featured Tours Section -->


  <!-- Reviews Section -->
  <section id="testimonials-home" class="testimonials-home section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Customer Reviews</h2>
      <div><span>What Our Customers</span> <span class="description-title">Are Saying</span></div>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="swiper init-swiper">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 1,
                "spaceBetween": 40
              },
              "1200": {
                "slidesPerView": 3,
                "spaceBetween": 1
              }
            }
          }
        </script>
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>“JCY didn’t just plan our trip they gave us a story to tell for a lifetime. I’ll never forget it.”</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
              <img src="assets/img/profile/beach.jpg" class="testimonial-img" alt="Emma Lee">
              <h3>Sarah J.</h3>
              <h4>Traveler</h4>
              <div class="stars" style="color: #ff9d00; font-size: 1.2rem;">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i> <!-- 5 stars -->
              </div>
            </div>
          </div><!-- End review item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>“The temples were stunning, but it was the kindness of the JCY team that made Cambodia unforgettable.”</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
              <img src="assets/img/profile/angk.jpg" class="testimonial-img" alt="David Tran">
              <h3>Leo T.</h3>
              <h4>Traveler</h4>
              <div class="stars" style="color: #ff9d00; font-size: 1.2rem;">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-half"></i> <!-- 4.5 stars -->
              </div>
            </div>
          </div><!-- End review item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>“I never felt like a tourist—JCY made me feel like part of the country. That’s rare.”</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
              <img src="assets/img/profile/fami.jpg" class="testimonial-img" alt="Sophia Richards">
              <h3>Anika R.</h3>
              <h4>Traveler</h4>
              <div class="stars" style="color: #ff9d00; font-size: 1.2rem;">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star"></i> <!-- 4 stars -->
              </div>
            </div>
          </div><!-- End review item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>“Every promise they made, they delivered—and then some. Best travel experience I’ve had.”</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
              <img src="assets/img/profile/gl-sit.jpg" class="testimonial-img" alt="Ravi Patel">
              <h3>Danny P.</h3>
              <h4>Freelancer</h4>
              <div class="stars" style="color: #ff9d00; font-size: 1.2rem;">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star"></i> <!-- 4 stars -->
              </div>
            </div>
          </div><!-- End review item -->

         


        </div>

        <div class="swiper-pagination"></div>
      </div>

    </div>

  </section><!-- /review Section -->

  <!-- Call To Action Section -->
  <section id="call-to-action" class="call-to-action section light-background">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="hero-content" data-aos="zoom-in" data-aos-delay="200">
        <div class="content-wrapper">
          <div class="badge-wrapper">
            <span class="promo-badge">Limited Time Offer</span>
          </div>
          <h2>Discover Your Next Adventure</h2>
          <p>Unlock incredible destinations with our specially curated travel packages. From exotic beaches to mountain peaks, your perfect getaway awaits.</p>

          <div class="action-section">
            <div class="main-actions">
              <a href="tours.php" class="btn btn-explore">
                <i class="bi bi-compass"></i>
                Explore Now
              </a>
              <a href="tours/custome-tour.php" class="btn btn-deals">
                <i class="bi bi-percent"></i>
                Plan Your Journey
              </a>
            </div>

            <div class="quick-contact">
              <span class="contact-label">Need help choosing?</span>
              <a href="tel:+1555123456" class="contact-link">
                <i class="bi bi-telephone"></i>
                Call ​​(+855) 97 559 0178
              </a>
            </div>
          </div>
        </div>

        <div class="visual-element">
          <img src="assets/img/Angkorwat/temple.jpg" alt="Travel Adventure" class="hero-image" loading="lazy">
          <div class="image-overlay">
            <div class="stat-item">
              <span class="stat-number">500+</span>
              <span class="stat-label">Destinations</span>
            </div>
            <div class="stat-item">
              <span class="stat-number">10K+</span>
              <span class="stat-label">Happy Travelers</span>
            </div>
          </div>
        </div>
      </div>

      <div class="newsletter-section" data-aos="fade-up" data-aos-delay="300">
        <div class="newsletter-card">
          <div class="newsletter-content">
            <div class="newsletter-icon">
              <i class="bi bi-envelope-heart"></i>
            </div>
            <div class="newsletter-text">
              <h3>Stay in the Loop</h3>
              <p>Get exclusive travel deals and destination guides delivered to your inbox</p>
            </div>
          </div>

          <form id="newsletterForm" class="newsletter-form">
            <div class="form-wrapper">
              <input type="email" name="email" id="emailInput" class="email-input" placeholder="Your email address" required>
              <button type="submit" class="subscribe-btn">
                <i class="bi bi-arrow-right"></i>
              </button>
            </div>

            <div class="loading text-center mt-2" style="display: none;">Loading...</div>
            <div class="error-message" style="display: none;"></div>
            <div class="sent-message text-center mt-2" style="display: none;">Welcome aboard! Check your email for exclusive offers.</div>

            <div class="trust-indicators">
              <i class="bi bi-lock"></i>
              <span>We protect your privacy. Unsubscribe anytime.</span>
            </div>
          </form>

        </div>
      </div>

      <div class="benefits-showcase" data-aos="fade-up" data-aos-delay="400">
        <div class="benefits-header">
          <h3>Why Choose Our Adventures</h3>
          <p>Experience the difference with our premium travel services</p>
        </div>

        <div class="benefits-grid">
          <div class="benefit-card" data-aos="flip-left" data-aos-delay="450">
            <div class="benefit-visual">
              <div class="benefit-icon-wrap">
                <i class="bi bi-geo-alt"></i>
              </div>
              <div class="benefit-pattern"></div>
            </div>
            <div class="benefit-content">
              <h4>Handpicked Destinations</h4>
              <p>Every location is carefully selected by our travel experts for authentic experiences</p>
            </div>
          </div>

          <div class="benefit-card" data-aos="flip-left" data-aos-delay="500">
            <div class="benefit-visual">
              <div class="benefit-icon-wrap">
                <i class="bi bi-award"></i>
              </div>
              <div class="benefit-pattern"></div>
            </div>
            <div class="benefit-content">
              <h4>Award-Winning Service</h4>
              <p>Recognized for excellence with 5-star ratings and industry awards</p>
            </div>
          </div>

          <div class="benefit-card" data-aos="flip-left" data-aos-delay="550">
            <div class="benefit-visual">
              <div class="benefit-icon-wrap">
                <i class="bi bi-heart"></i>
              </div>
              <div class="benefit-pattern"></div>
            </div>
            <div class="benefit-content">
              <h4>Personalized Care</h4>
              <p>Tailored itineraries designed around your preferences and travel style</p>
            </div>
          </div>
        </div>
      </div>

    </div>

  </section><!-- /Call To Action Section -->

</main>


<?php include 'partials/_footer.php'; ?>
<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>
<script src="forms/newsletter.js" defer></script>

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

<!-- Cookie Consent Banner -->
<style>
  #cookie-banner {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: #e8f9f7;
    border-top: 1px solid #ccc;
    padding: 1rem 1.5rem;
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #222;
    box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.1);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  #cookie-banner.hidden {
    display: none !important;
  }
</style>

<div id="cookie-banner" class="hidden">
  <div style="max-width: 70%;">
    We use cookies to improve your trip planning experience. By clicking <strong>“Accept All”</strong>, you agree to help us remember your preferences, enhance site performance, and offer more personalized travel options.&nbsp;
    <a href="/privacy" target="_blank" style="color:#11a4fd; font-weight: 600; text-decoration: underline;">Privacy & Cookies Policy</a>
  </div>

  <div style="display: flex; gap: 0.5rem; align-items:center;">
    <button id="cookie-settings-btn" style="background: white; border: 1px solid #11a4fd; color: #11a4fd; padding: 0.4rem 1rem; border-radius: 4px; cursor: pointer; font-weight: 600;">Cookies Settings</button>
    <button id="cookie-accept-btn" style="background: #11a4fd; border: none; color: white; padding: 0.5rem 1.3rem; border-radius: 4px; cursor: pointer; font-weight: 700;">Accept All</button>
    <button id="cookie-close-btn" aria-label="Close cookie consent banner" style="background: transparent; border: none; font-weight: 700; font-size: 1.3rem; cursor: pointer; color: #333;">×</button>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const cookieConsentKey = 'cookieConsentGiven';
    const banner = document.getElementById('cookie-banner');
    const acceptBtn = document.getElementById('cookie-accept-btn');
    const closeBtn = document.getElementById('cookie-close-btn');
    const settingsBtn = document.getElementById('cookie-settings-btn');

    function hideBanner() {
      banner.classList.add('hidden');
    }

    function showBanner() {
      banner.classList.remove('hidden');
    }

    function acceptCookies() {
      localStorage.setItem(cookieConsentKey, 'true');
      hideBanner();
    }

    if (localStorage.getItem(cookieConsentKey) !== 'true') {
      showBanner();
    }

    acceptBtn.addEventListener('click', acceptCookies);
    closeBtn.addEventListener('click', hideBanner);
    settingsBtn.addEventListener('click', () => {
      alert("Show cookie settings modal or page here.");
    });
  });
</script>

</body>

</html>