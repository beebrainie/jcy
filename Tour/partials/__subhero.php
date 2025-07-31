<?php
// Get current page filename without extension
$currentPage = basename($_SERVER['PHP_SELF'], ".php");

// Define page titles and descriptions
$pageInfo = [
    'index' => [
        'title' => 'Home',
        'description' => 'Welcome to our official tourism platform — discover, explore, and book your next Cambodian adventure.'
    ],
    'about' => [
        'title' => 'About',
        'description' => 'Learn more about our mission, values, and the team behind your Cambodian journey.'
    ],
    'destinations' => [
        'title' => 'Destinations',
        'description' => 'Discover Cambodia’s top travel destinations — from ancient temples to scenic beaches.'
    ],
    'destination-details' => [
        'title' => 'Destination Details',
        'description' => 'Get in-depth information about this unique Cambodian destination.'
    ],
    'blog' => [
        'title' => 'Blog',
        'description' => 'Read travel stories, guides, and tips from our tourism experts and guests.'
    ],
    'blog-details' => [
        'title' => 'Blog Details',
        'description' => 'Explore the full story and insights from our latest blog post.'
    ],
    'booking' => [
        'title' => 'Booking',
        'description' => 'Confirm your tour packages and secure your spot with our simple booking process.'
    ],
    'contact' => [
        'title' => 'Contact',
        'description' => 'Have questions or need help? Reach out to our friendly team — we’re here to assist you.'
    ],
    'faq' => [
        'title' => 'FAQ',
        'description' => 'Find answers to common questions about our services, tours, and booking process.'
    ],
    'gallery' => [
        'title' => 'Gallery',
        'description' => 'Browse stunning photos of Cambodia and highlights from our past tours.'
    ],
    'privacy' => [
        'title' => 'Privacy Policy',
        'description' => 'Read how we protect your privacy and handle your personal data.'
    ],
    'terms' => [
        'title' => 'Terms & Conditions',
        'description' => 'Review the terms and conditions of using our services and platform.'
    ],
    'tours' => [
        'title' => 'Tours',
        'description' => 'Explore our curated tours across Cambodia, from ancient temples to cultural escapes.'
    ],
    'tour-details' => [
        'title' => 'Tour Details',
        'description' => 'Learn more about this specific tour, itinerary, and what’s included.'
    ],
];

// Fallback if the page is not listed
$pageTitle = $pageInfo[$currentPage]['title'] ?? 'Welcome';
$pageDescription = $pageInfo[$currentPage]['description'] ?? 'Explore more about this page.';
?>

<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade" style="background-image: url(../assets/img/Angkorwat/bg.jpg);">
    <div class="container position-relative">
        <h1><?= htmlspecialchars($pageTitle) ?></h1>
        <p><?= htmlspecialchars($pageDescription) ?></p>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="../index.php">Home</a></li>
                <li class="current"><?= htmlspecialchars($pageTitle) ?></li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->