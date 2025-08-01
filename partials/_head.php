<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JCY Tours | Explore Cambodia with Trusted Local Experts</title>
    <meta name="description" content="Discover unforgettable tours in Cambodia with JCY Tours. Book trusted local adventures, tailored packages, and explore stunning destinations.">
    <meta name="keywords" content="Cambodia Tours, JCY Travel, Phnom Penh, Siem Reap, Angkor Wat, Local Tour Packages, Travel Cambodia">
    <meta name="robots" content="index, follow">
    <meta name="author" content="JCY Tours">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="JCY Tours | Explore Cambodia">
    <meta property="og:description" content="Explore Cambodia with trusted tour packages and expert guides.">
    <meta property="og:image" content="https://yourdomain.com/assets/img/JCY-Logo.png">
    <meta property="og:url" content="https://yourdomain.com/">
    <meta property="og:type" content="website">

    <!-- Twitter Meta -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="JCY Tours | Explore Cambodia">
    <meta name="twitter:description" content="Plan your next trip with expert local tours in Cambodia.">
    <meta name="twitter:image" content="https://yourdomain.com/assets/img/JCY-Logo.png">

    <!-- Favicons -->
    <link rel="icon" href="assets/img/JCY-Logo.png">
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

    <!-- Preconnect & Preload Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@400;500;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet" media="all">

    <!-- Vendor CSS (Consider minifying or combining if self-hosted) -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/vendor/aos/aos.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/vendor/glightbox/css/glightbox.min.css">

    <!-- Font Awesome from CDN (Use only if needed) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-yf...snipped..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Main CSS (minified version preferred) -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="preload" href="assets/fonts/your-font.woff2" as="font" type="font/woff2" crossorigin>

</head>


<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="assets/img/logo.webp" alt="">
                <!-- <h1 class="sitename">Tour</h1> -->
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php" class="<?= $currentPage == 'index.php' ? 'active' : '' ?>">Home</a></li>
                    <li><a href="about.php" class="<?= $currentPage == 'about.php' ? 'active' : '' ?>">About</a></li>
                    <li><a href="tours/custom-tour.php" class="<?= $currentPage == 'tours/custome-tour.php' ? 'active' : '' ?>">Destinations</a></li>
                    <li class="dropdown">
                        <a href="#"><span>Tours</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="tours.php" class="<?= $currentPage == 'tours.php' ? 'active' : '' ?>">Tour Packages</a></li>
                            <li><a href="tours/custom-tour.php" class="<?= $currentPage == 'tours/custom-tour.php' ? 'active' : '' ?>">Custom Tour</a></li>
                            <li><a href="tours/cart.php" class="<?= $currentPage == 'tours/cart.php' ? 'active' : '' ?>">Cart</a></li>
                        </ul>
                    </li>
                    <!-- <li><a href="tours.php" class="<?= $currentPage == 'tours.php' ? 'active' : '' ?>">Tours</a></li> -->
                    <li><a href="gallery.php" class="<?= $currentPage == 'gallery.php' ? 'active' : '' ?>">Gallery</a></li>
                    <li><a href="blog.php" class="<?= $currentPage == 'blog.php' ? 'active' : '' ?>">Blog</a></li>
                    <li><a href="contact.php" class="<?= $currentPage == 'contact.php' ? 'active' : '' ?>">Contact</a></li>
                    <li class="dropdown">
                        <a href="#"><span>Languages</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="/en/"><img src="assets/img/lang/Flag_of_the_United_Kingdom.png" alt="English" width="20" style="margin-right: 8px;">English</a></li>
                            <li><a href="/fr/"><img src="assets/img/lang/Flag_of_France.svg.png" alt="Français" width="20" style="margin-right: 8px;">Français</a></li>
                            <li><a href="/km/"><img src="assets/img/lang/Flag_of_Cambodia.svg.png" alt="Khmer" width="20" style="margin-right: 8px;">ខ្មែរ</a></li>
                            <li><a href="/vi/"><img src="assets/img/lang/Flag_of_Vietnam.svg.webp" alt="Vietnamese" width="20" style="margin-right: 8px;">Tiếng Việt</a></li>
                            <li><a href="/zh/"><img src="assets/img/lang/Flag_of_China.png" alt="中文" width="20" style="margin-right: 8px;">中文 (繁體)</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="tours/my-booking.php" title="Your Dashboard" class="<?= $currentPage == 'tours/my-booking.php' ? 'active' : '' ?>" style="display: flex; align-items: center;">
                            <i class="fas fa-user-circle" style="font-size: 25px;"></i>
                        </a>
                    </li>


                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

            </nav>


            <a class="btn-getstarted" href="/tours.php">Book Now</a>

        </div>
    </header>