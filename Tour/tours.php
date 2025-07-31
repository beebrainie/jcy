<?php
include 'partials/_head.php';
include 'partials/_subhero.php';
?>

<body>


  <main class="main">
    <section id="travel-tours" class="travel-tours section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-8 mx-auto text-center mb-5">
            <h2>Find Your Perfect Tour</h2>
            <p>Discover unforgettable travel experiences with our curated collection of tours. Explore by destination, travel style, or date to find the adventure that's perfect for you.</p>
          </div>
        </div>

        <?php
        require_once 'config/db.php';

        $sql = "SELECT id, tour_name, price_start, durations, description FROM package_tours ORDER BY id DESC LIMIT 6";
        $result = $mysqli->query($sql);

        $tourImages = [
          'assets/img/Angkorwat/angk.jpg',
          'assets/img/Bayon Temple,/ancient-khmer-architecture-amazing-view-bayon-temple-sunset-angkor-wat-complex_558469-4830.avif',
          'assets/img/Baphuon/HA5D5069.jpg',
          'assets/img/royalpalace/royal-palace-1920x1200.jpg',
          'assets/img/sea/kohrongs.jpg',
          'assets/img/Angkorwat/angkor01.jpg',
        ];
        $imageIndex = 0;
        ?>

        <div class="row mb-5" data-aos="fade-up" data-aos-delay="300">
          <div class="col-12">
            <h3 class="section-subtitle mb-4">Popular Tours</h3>

            <div class="featured-tours-slider swiper init-swiper">
              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": 1,
                  "spaceBetween": 30,
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  },
                  "breakpoints": {
                    "768": {
                      "slidesPerView": 2
                    },
                    "1200": {
                      "slidesPerView": 3
                    }
                  }
                }
              </script>

              <div class="swiper-wrapper">
                <?php if ($result && $result->num_rows > 0): ?>
                  <?php while ($tour = $result->fetch_assoc()): ?>
                    <?php
                    $imagePath = $tourImages[$imageIndex % count($tourImages)];
                    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $tour['tour_name'])));
                    $imageIndex++;
                    ?>
                    <div class="swiper-slide">
                      <div class="featured-tour-card">
                        <div class="tour-image">
                          <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($tour['tour_name']) ?>" class="img-fluid">
                          <div class="tour-badge">Popular</div>
                        </div>
                        <div class="tour-content">
                          <h4><?= htmlspecialchars($tour['tour_name']) ?></h4>
                          <p><?= htmlspecialchars(mb_strimwidth($tour['description'], 0, 120, "...")) ?></p>
                          <div class="tour-meta">
                            <span class="duration">
                              <i class="bi bi-clock"></i> <?= (int)$tour['durations'] ?> Days
                            </span>
                            <span class="price">From $<?= number_format($tour['price_start'], 2) ?></span>
                          </div>
                          <a href="tours/<?= urlencode($slug) ?>.php" class="btn btn-outline-primary">View Tour</a>

                        </div>
                      </div>
                    </div>
                  <?php endwhile; ?>
                <?php else: ?>
                  <div class="swiper-slide">
                    <p>No tours available at the moment.</p>
                  </div>
                <?php endif; ?>
              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>

        <!-- Special Offers -->
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="500">
          <div class="col-12">
            <div class="special-offers">
              <h3 class="section-subtitle mb-4">Last-Minute Deals</h3>
              <div class="row">
                <div class="col-lg-6 mb-4">
                  <div class="offer-banner">
                    <div class="offer-content">
                      <div class="discount-badge">30% OFF</div>
                      <h4>Mediterranean Cruise</h4>
                      <p>Explore Italy, Greece, and Spain with luxury accommodations and gourmet dining.</p>
                      <span class="urgency">Only 3 seats left!</span>
                      <a href="booking.html" class="btn btn-accent">Book Now</a>
                    </div>
                    <div class="offer-image">
                      <img src="assets/img/travel/misc-12.webp" alt="Cruise" class="img-fluid">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="offer-banner">
                    <div class="offer-content">
                      <div class="discount-badge">25% OFF</div>
                      <h4>African Safari</h4>
                      <p>Witness the great migration and encounter magnificent wildlife in their natural habitat.</p>
                      <span class="urgency">Limited time offer!</span>
                      <a href="booking.html" class="btn btn-accent">Book Now</a>
                    </div>
                    <div class="offer-image">
                      <img src="assets/img/travel/misc-8.webp" alt="Safari" class="img-fluid">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- All Tours Section -->
        <?php
        $sql2 = "SELECT id, tour_name, price_start, durations, description FROM package_tours";
        $result2 = $mysqli->query($sql2);

        $tourImages2 = [
          'assets/img/Angkorwat/angk.jpg',
          'assets/img/Bayon Temple,/ancient-khmer-architecture-amazing-view-bayon-temple-sunset-angkor-wat-complex_558469-4830.avif',
          'assets/img/koh ker/kohker.jpg',
          'assets/img/Preah Vihear/prehvihea.jpg',
          'assets/img/bamboo/bambootrains.jpg',
          'assets/img/kulen/Phnom-Kulen-Waterfall-02-853x640-1.jpg',
          'assets/img/tole sap//Sunset-Tonle-Sap-Lake-01-853x6401-1.jpg',
          'assets/img/banteaysrey/Banteay Srey.jpg',
          'assets/img/Angkorwat/angkor01.jpg',
          'assets/img/Oudong Mountain/oudong_11.jpg',
          'assets/img/tole sap/Tonle Bai.jpg',
          'assets/img/Bokur/beautiful-sun-shining-across-mountains.jpg',
          'assets/img/koh kong/95c599a79fc5e81fbb702442db5e4be5.jpg',
          'assets/img/Pottery Village/Kampong Cham.jpg',
          'assets/img/Angkorwat/angkor04.jpg',
          'assets/img/sea/kohrongs.jpg',
          'assets/img/royalpalace/royal-palace-1920x1200.jpg',
          'assets/img/Baphuon/HA5D5069.jpg',
          'assets/img/City/inc.jpg',
          'assets/img/Bayon Temple,/ancient-khmer-architecture-amazing-view-bayon-temple-sunset-angkor-wat-complex_558469-4830.avif',
        ];
        $imageIndex2 = 0;
        ?>

        <div class="row" data-aos="fade-up" data-aos-delay="600">
          <div class="col-12">
            <h3 class="section-subtitle mb-4">All Tours</h3>
            <div class="row">
              <?php if ($result2 && $result2->num_rows > 0): ?>
                <?php while ($tour = $result2->fetch_assoc()): ?>
                  <?php
                  $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $tour['tour_name'])));
                  $img = $tourImages2[$imageIndex2 % count($tourImages2)];
                  $imageIndex2++;
                  ?>
                  <div class="col-lg-4 col-md-6 mb-4">
                    <div class="tour-card">
                      <div class="tour-image">
                        <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($tour['tour_name']) ?>" class="img-fluid">
                        <div class="tour-price">$<?= number_format($tour['price_start'], 2) ?></div>
                      </div>
                      <div class="tour-content">
                        <h4><?= htmlspecialchars($tour['tour_name']) ?></h4>
                        <p><?= htmlspecialchars(mb_strimwidth($tour['description'], 0, 120, '...')) ?></p>
                        <div class="tour-details">
                          <span><i class="bi bi-clock"></i> <?= (int)$tour['durations'] ?> Days</span>
                        </div>
                        <a href="tours/<?= urlencode($slug) ?>.php" class="btn btn-outline-primary">View Tour</a>

                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              <?php else: ?>
                <p>No tours available at the moment.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <?php $mysqli->close(); ?>

        <!-- CTA Section -->
        <div class="row" data-aos="fade-up" data-aos-delay="700">
          <div class="col-12 text-center">
            <div class="cta-section">
              <h3>Not Sure What to Choose?</h3>
              <p>Our travel experts are here to help you find the perfect tour based on your preferences and budget.</p>
              <div class="cta-buttons">
                <a href="#" class="btn btn-primary me-3">Contact Our Experts</a>
                <a href="#" class="btn btn-outline-primary">Take Our Travel Quiz</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </main>


  <!-- Promo Popup -->
  <style>
    #promoPopupOverlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.7);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    #promoPopup {
      background: #fff;
      padding: 30px 20px;
      border-radius: 20px;
      max-width: 400px;
      width: 90%;
      text-align: center;
      animation: popupIn 0.3s ease;
      position: relative;
    }

    @keyframes popupIn {
      from {
        transform: scale(0.7);
        opacity: 0;
      }

      to {
        transform: scale(1);
        opacity: 1;
      }
    }

    #promoPopup h2 {
      color: #e67e22;
      font-size: 22px;
      margin-bottom: 10px;
    }

    #promoPopup p {
      font-size: 16px;
      margin-bottom: 20px;
    }

    #promoPopup button {
      background: #11a4fd;
      color: #fff;
      border: none;
      padding: 10px 25px;
      font-size: 16px;
      border-radius: 50px;
      cursor: pointer;
    }

    #promoPopup .close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 20px;
      cursor: pointer;
    }
  </style>

  <div id="promoPopupOverlay">
    <div id="promoPopup">
      <div class="close-btn" onclick="closePromo()">✕</div>
      <h2>🎉 Special Tour Deal!</h2>
      <p>Book now and enjoy up to <strong>30% OFF</strong> selected private tours!</p>
      <button onclick="closePromo()">Start Booking</button>
    </div>
  </div>

  <script>
    function closePromo() {
      document.getElementById('promoPopupOverlay').style.display = 'none';
    }

    window.addEventListener('load', function() {
      // Always show promo after short delay
      setTimeout(() => {
        document.getElementById('promoPopupOverlay').style.display = 'flex';
      }, 500);
    });
  </script>

</body>
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