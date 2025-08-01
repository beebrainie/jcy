<?php
  include '../partials/__head.php';
  include '../partials/__userhero.php';

  require_once '../config/db.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingCode = trim($_POST['booking_code']);
    $email = trim($_POST['email']);

    // Escape inputs for safety
    $bookingCode = mysqli_real_escape_string($mysqli, $bookingCode);
    $email = mysqli_real_escape_string($mysqli, $email);

    // Try to find in custom_tour table (joined with customers)
    $custom_sql = "SELECT c.*, u.email 
                  FROM custom_tour c
                  JOIN customers u ON c.user_id = u.id
                  WHERE c.booking_code = '$bookingCode' AND u.email = '$email'";
    $custom_result = mysqli_query($mysqli, $custom_sql);

    // Try to find in booking_tour table (joined with customers)
    $package_sql = "SELECT b.*, u.email 
                    FROM booking_tour b
                    JOIN customers u ON b.customer_id = u.id
                    WHERE b.booking_code = '$bookingCode' AND u.email = '$email'";
    $package_result = mysqli_query($mysqli, $package_sql);
    if (mysqli_num_rows($custom_result) > 0) {
      $booking = mysqli_fetch_assoc($custom_result);
      echo "<div class='alert alert-success'><strong>Custom Tour Found!</strong><br>
              Tour: {$booking['tour_name']}<br>
              Start: {$booking['start_date']}<br>
              Adults: {$booking['num_adults']}<br>
              Children: {$booking['num_children']}<br>
              Destination: {$booking['destination']}<br>
              Booking Code: {$booking['booking_code']}
            </div>";
    } elseif (mysqli_num_rows($package_result) > 0) {
      $booking = mysqli_fetch_assoc($package_result);
      echo "<div class='alert alert-success'><strong>Package Tour Found!</strong><br>
              Tour ID: {$booking['tour_id']}<br>
              Booking Date: {$booking['book_date']}<br>
              Adults: {$booking['adults']}<br>
              Children: {$booking['children']}<br>
              Status: {$booking['status']}<br>
              Booking Code: {$booking['booking_code']}
            </div>";
    } else {
      echo "<div class='alert alert-danger'>No booking found with that code and email.</div>";
    }
  }
?>


<head>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }



    .user-dashboard-container {
      display: flex;
      min-height: 100vh;
      gap: 20px;
      padding: 20px;
      max-width: 1400px;
      margin: 0 auto;
    }

    /* Left Sidebar Column */
    .dashboard-sidebar-column {
      width: 280px;
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    /* User Profile Card */
    .user-profile-widget {
      background: linear-gradient(135deg, #4FC3F7, #29B6F6);
      border-radius: 16px;
      padding: 24px;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .user-profile-widget::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
    }

    .user-profile-header {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 20px;
      position: relative;
      z-index: 2;
    }

    .user-profile-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      border: 3px solid rgba(255, 255, 255, 0.3);
      object-fit: cover;
    }

    .user-profile-info h2 {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 2px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .user-profile-stars {
      display: flex;
      gap: 2px;
    }

    .user-profile-stars i {
      font-size: 12px;
      color: #FFD700;
    }

    .user-profile-level {
      font-size: 14px;
      opacity: 0.9;
      margin-bottom: 16px;
    }

    .user-update-info {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
      opacity: 0.9;
      margin-bottom: 20px;
      cursor: pointer;
      transition: opacity 0.3s;
      position: relative;
      z-index: 2;
    }

    .user-update-info:hover {
      opacity: 1;
    }

    .user-membership-badge {
      background: rgba(255, 255, 255, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 20px;
      padding: 8px 16px;
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 12px;
      font-weight: 500;
      margin-bottom: 16px;
      position: relative;
      z-index: 2;
    }

    .user-badge-text {
      background: #1E40AF;
      color: white;
      padding: 2px 8px;
      border-radius: 12px;
      font-size: 10px;
      font-weight: 600;
    }

    .user-benefits-text {
      font-size: 13px;
      opacity: 0.9;
      position: relative;
      z-index: 2;
    }

    /* Navigation Menu */
    .dashboard-navigation {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .nav-menu-section {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .nav-menu-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 20px;
      border-bottom: 1px solid #f0f0f0;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
      color: #333;
    }

    .nav-menu-item:last-child {
      border-bottom: none;
    }

    .nav-menu-item:hover {
      background-color: #f8f9fa;
    }

    .nav-menu-item.nav-item-active {
      background-color: #fff3e0;
      color: #ff6b35;
      border-left: 4px solid #ff6b35;
    }

    .nav-menu-left {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .nav-menu-icon {
      width: 20px;
      text-align: center;
      font-size: 16px;
    }

    .nav-menu-text {
      font-weight: 500;
      font-size: 15px;
    }

    .nav-menu-count {
      background: #ff6b35;
      color: white;
      padding: 2px 8px;
      border-radius: 12px;
      font-size: 12px;
      font-weight: 600;
    }

    .nav-menu-arrow {
      color: #ccc;
      font-size: 12px;
    }

    /* Main Content Area */
    .dashboard-main-content {
      flex: 1;
      background: white;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .dashboard-content-section {
      display: none;
    }

    .dashboard-content-section.section-active {
      display: block;
    }

    .dashboard-empty-state {
      text-align: center;
      padding: 60px 20px;
    }

    .dashboard-empty-icon {
      width: 120px;
      height: 120px;
      margin: 0 auto 24px;
      background: linear-gradient(135deg, #FFB74D, #FF9800);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 48px;
      color: white;
    }

    .dashboard-empty-title {
      font-size: 24px;
      font-weight: 600;
      color: #333;
      margin-bottom: 12px;
    }

    .dashboard-empty-subtitle {
      font-size: 16px;
      color: #666;
      margin-bottom: 30px;
    }

    .dashboard-recommendations-section h3 {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 24px;
      color: #333;
    }

    .dashboard-recommendations-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
    }

    .dashboard-recommendation-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s, box-shadow 0.3s;
      cursor: pointer;
      position: relative;
    }

    .dashboard-recommendation-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .dashboard-card-image {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .dashboard-card-content {
      padding: 20px;
    }

    .dashboard-card-title {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 8px;
      color: #333;
    }

    .dashboard-card-subtitle {
      font-size: 14px;
      color: #666;
      margin-bottom: 12px;
    }

    .dashboard-card-rating {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 8px;
    }

    .dashboard-rating-stars {
      color: #FFD700;
      font-size: 14px;
    }

    .dashboard-rating-text {
      font-size: 13px;
      color: #666;
    }

    .dashboard-special-offer {
      position: absolute;
      top: 12px;
      left: 12px;
      background: #FF4444;
      color: white;
      padding: 6px 12px;
      border-radius: 16px;
      font-size: 12px;
      font-weight: 600;
    }

    .dashboard-price-tag {
      position: absolute;
      top: 12px;
      right: 12px;
      background: #1976D2;
      color: white;
      padding: 8px 12px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
    }

    /* Bookings Content */
    .dashboard-bookings-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .dashboard-bookings-title {
      font-size: 24px;
      font-weight: 600;
      color: #333;
    }

    .dashboard-filter-dropdown {
      padding: 10px 16px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background: white;
      font-size: 14px;
      cursor: pointer;
      min-width: 150px;
    }

    .dashboard-booking-item {
      background: white;
      border: 1px solid #eee;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 16px;
      transition: all 0.3s;
    }

    .dashboard-booking-item:hover {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transform: translateY(-2px);
    }

    .dashboard-booking-content {
      display: flex;
      gap: 20px;
    }

    .dashboard-booking-image {
      width: 120px;
      height: 90px;
      border-radius: 8px;
      object-fit: cover;
    }

    .dashboard-booking-details {
      flex: 1;
    }

    .dashboard-booking-header-info {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 12px;
    }

    .dashboard-booking-title {
      font-size: 18px;
      font-weight: 600;
      color: #333;
      margin-bottom: 4px;
    }

    .dashboard-booking-location {
      font-size: 14px;
      color: #666;
      margin-bottom: 8px;
    }

    .dashboard-booking-meta {
      display: flex;
      gap: 20px;
      font-size: 14px;
      color: #666;
    }

    .dashboard-booking-price {
      font-size: 20px;
      font-weight: 700;
      color: #333;
      margin-bottom: 8px;
    }

    .dashboard-status-badge {
      padding: 6px 12px;
      border-radius: 16px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
    }

    .dashboard-status-confirmed {
      background: #e8f5e8;
      color: #2e7d32;
    }

    .dashboard-status-pending {
      background: #fff3e0;
      color: #f57c00;
    }

    .dashboard-status-completed {
      background: #e3f2fd;
      color: #1976d2;
    }

    .dashboard-status-cancelled {
      background: #ffebee;
      color: #d32f2f;
    }

    .dashboard-booking-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 16px;
      padding-top: 16px;
      border-top: 1px solid #f0f0f0;
    }

    .dashboard-booking-id {
      font-size: 13px;
      color: #999;
    }

    .dashboard-action-buttons {
      display: flex;
      gap: 8px;
    }

    .dashboard-btn {
      padding: 8px 16px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      font-size: 13px;
      font-weight: 500;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.3s;
    }

    .dashboard-btn-primary {
      background: #1976d2;
      color: white;
    }

    .dashboard-btn-primary:hover {
      background: #1565c0;
    }

    .dashboard-btn-success {
      background: #388e3c;
      color: white;
    }

    .dashboard-btn-success:hover {
      background: #2e7d32;
    }

    /* Profile Content */
    .dashboard-profile-content {
      max-width: 800px;
    }

    .dashboard-profile-section-title {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 30px;
      color: #333;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .dashboard-edit-profile-btn {
      background: #1976d2;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      font-weight: 500;
      transition: background 0.3s;
    }

    .dashboard-edit-profile-btn:hover {
      background: #1565c0;
    }

    .dashboard-profile-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
    }

    .dashboard-profile-info-card {
      background: #f8f9fa;
      border-radius: 12px;
      padding: 24px;
    }

    .dashboard-profile-avatar-section {
      display: flex;
      align-items: center;
      gap: 20px;
      margin-bottom: 24px;
    }

    .dashboard-profile-avatar-large {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
    }

    .dashboard-profile-name {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 4px;
    }

    .dashboard-profile-level-text {
      color: #666;
      margin-bottom: 8px;
    }

    .dashboard-info-row {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 16px;
    }

    .dashboard-info-icon {
      width: 20px;
      color: #666;
      text-align: center;
    }

    .dashboard-info-details {
      flex: 1;
    }

    .dashboard-info-label {
      font-size: 12px;
      color: #999;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 2px;
    }

    .dashboard-info-value {
      font-weight: 600;
      color: #333;
    }

    .dashboard-membership-info-card {
      background: linear-gradient(135deg, #1976d2, #1565c0);
      color: white;
      border-radius: 12px;
      padding: 24px;
    }

    .dashboard-membership-title {
      font-size: 18px;
      margin-bottom: 8px;
    }

    .dashboard-membership-benefits {
      opacity: 0.9;
      margin-bottom: 20px;
    }

    .dashboard-klook-cash-amount {
      font-size: 32px;
      font-weight: 700;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .user-dashboard-container {
        flex-direction: column;
        padding: 10px;
      }

      .dashboard-sidebar-column {
        width: 100%;
      }

      .dashboard-profile-grid {
        grid-template-columns: 1fr;
      }

      .dashboard-recommendations-grid {
        grid-template-columns: 1fr;
      }

      .dashboard-booking-content {
        flex-direction: column;
      }

      .dashboard-booking-image {
        width: 100%;
        height: 150px;
      }

      .dashboard-booking-header-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }

      .dashboard-booking-actions {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }
    }
  </style>
</head>

<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade" style="background-image: url(../assets/img/Angkorwat/beadcrumb.jpg);">
  <div class="container position-relative">
    <h1><?= htmlspecialchars($pageTitle) ?></h1>
    <p><?= htmlspecialchars($pageDescription) ?></p>
    <nav class="breadcrumbs">
      <ol>
        <li><a href="index.php">Home</a></li>
        <li class="current">Your Dashboard</li>
      </ol>
    </nav>
  </div>
</div>


<main class="main">
  <div class="user-dashboard-container">
    <!-- Left Sidebar Column -->
    <div class="dashboard-sidebar-column">
      <!-- User Profile Card -->
      <div class="user-profile-widget">
        <div class="user-profile-header">
          <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face" alt="Profile" class="user-profile-avatar">
          <div class="user-profile-info">
            <h2>
              <span class="user-profile-stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </span>
              Brian
            </h2>
          </div>
        </div>

        <div class="user-update-info" onclick="showDashboardSection('profile')">
          <span>Update personal info</span>
          <i class="fas fa-chevron-right"></i>
        </div>

        <div class="user-membership-badge">
          <i class="fas fa-check-circle"></i>
          <span class="user-badge-text">Lvl 1</span>
          <span>Explorer</span>
        </div>

        <div class="user-benefits-text">
          4 benefits, 1X JCYcash
          <i class="fas fa-chevron-right" style="margin-left: 8px;"></i>
        </div>
      </div>

      <!-- Navigation Menu -->
      <div class="dashboard-navigation">
        <div class="nav-menu-section">
          <a href="#" class="nav-menu-item" onclick="showDashboardSection('promo-codes')">
            <div class="nav-menu-left">
              <i class="fas fa-percent nav-menu-icon"></i>
              <span class="nav-menu-text">Promo codes</span>
            </div>
            <span class="nav-menu-count">1</span>
          </a>

          <a href="#" class="nav-menu-item" onclick="showDashboardSection('jcy-cash')">
            <div class="nav-menu-left">
              <i class="fas fa-coins nav-menu-icon"></i>
              <span class="nav-menu-text">JCYCash</span>
            </div>
            <span class="nav-menu-arrow">View</span>
          </a>
        </div>

        <div class="nav-menu-section">
          <a href="#" class="nav-menu-item nav-item-active" onclick="showDashboardSection('bookings')">
            <div class="nav-menu-left">
              <i class="fas fa-calendar-alt nav-menu-icon" style="color: #ff6b35;"></i>
              <span class="nav-menu-text">Bookings</span>
            </div>
            <i class="fas fa-chevron-right nav-menu-arrow"></i>
          </a>

          <a href="#" class="nav-menu-item" onclick="showDashboardSection('reviews')">
            <div class="nav-menu-left">
              <i class="fas fa-star nav-menu-icon"></i>
              <span class="nav-menu-text">Reviews</span>
            </div>
            <i class="fas fa-chevron-right nav-menu-arrow"></i>
          </a>

          <a href="#" class="nav-menu-item" onclick="showDashboardSection('payment')">
            <div class="nav-menu-left">
              <i class="fas fa-credit-card nav-menu-icon"></i>
              <span class="nav-menu-text">Payment methods</span>
            </div>
            <i class="fas fa-chevron-right nav-menu-arrow"></i>
          </a>

          <a href="#" class="nav-menu-item" onclick="showDashboardSection('participant')">
            <div class="nav-menu-left">
              <i class="fas fa-users nav-menu-icon"></i>
              <span class="nav-menu-text">Participant details</span>
            </div>
            <i class="fas fa-chevron-right nav-menu-arrow"></i>
          </a>

          <a href="#" class="nav-menu-item" onclick="showDashboardSection('delivery')">
            <div class="nav-menu-left">
              <i class="fas fa-truck nav-menu-icon"></i>
              <span class="nav-menu-text">Delivery details</span>
            </div>
            <i class="fas fa-chevron-right nav-menu-arrow"></i>
          </a>

          <a href="#" class="nav-menu-item" onclick="showDashboardSection('wishlists')">
            <div class="nav-menu-left">
              <i class="fas fa-heart nav-menu-icon"></i>
              <span class="nav-menu-text">Wishlists</span>
            </div>
            <i class="fas fa-chevron-right nav-menu-arrow"></i>
          </a>
        </div>

        <div class="nav-menu-section">
          <a href="#" class="nav-menu-item" onclick="showDashboardSection('login-methods')">
            <div class="nav-menu-left">
              <i class="fas fa-key nav-menu-icon"></i>
              <span class="nav-menu-text">Login methods</span>
            </div>
            <i class="fas fa-chevron-right nav-menu-arrow"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="dashboard-main-content">
      <!-- Bookings Section (Default Active) -->
      <div id="bookings" class="dashboard-content-section section-active">
        <div class="dashboard-empty-state">
          <div class="dashboard-empty-icon">
            <i class="fas fa-suitcase"></i>
          </div>
          <div class="dashboard-booking-lookup mb-4">
            <h3>Find Your Booking</h3>
            <form method="POST" action="" class="form-horizontal d-flex justify-content-center">
              <div class="mb-3">
                <label for="booking_code" class="form-label">Booking Code</label>
                <input type="text" id="booking_code" name="booking_code" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary">Check Booking</button>
            </form>
          </div>
          
         

          <h2 class="dashboard-empty-title">Nothing booked yet!</h2>
          <p class="dashboard-empty-subtitle">Need inspiration for adventure? Check out our recommendations below.</p>
        </div>

        <div class="dashboard-recommendations-section">
          <h3>Travelers' favorite choices</h3>
          <div class="dashboard-recommendations-grid">
            <!-- Card 1 -->
            <div class="dashboard-recommendation-card" onclick="bookNow('universal-studios')">
              <div class="dashboard-special-offer">Special Offer</div>
              <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=250&fit=crop" alt="Universal Studios" class="dashboard-card-image">
              <div class="dashboard-card-content">
                <h4 class="dashboard-card-title">Universal Studios Japan Studio Pass</h4>
                <p class="dashboard-card-subtitle">Book now for today</p>
                <div class="dashboard-card-rating">
                  <span class="dashboard-rating-stars">★★★★☆</span>
                  <span class="dashboard-rating-text">4.8 (74,610) • 4M+ booked</span>
                </div>
              </div>
            </div>

            <!-- Card 2 -->
            <div class="dashboard-recommendation-card" onclick="bookNow('tokyo-skytree')">
              <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=400&h=250&fit=crop" alt="Tokyo Skytree" class="dashboard-card-image">
              <div class="dashboard-card-content">
                <h4 class="dashboard-card-title">TOKYO SKYTREE® Ticket</h4>
                <p class="dashboard-card-subtitle">Book now for today</p>
                <div class="dashboard-card-rating">
                  <span class="dashboard-rating-stars">★★★★★</span>
                  <span class="dashboard-rating-text">4.7 (19,450) • 800K+ booked</span>
                </div>
              </div>
            </div>

            <!-- Card 3 -->
            <div class="dashboard-recommendation-card" onclick="bookNow('kansai-pass')">
              <div class="dashboard-special-offer">Special Offer</div>
              <div class="dashboard-price-tag">JPY 9,300</div>
              <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=400&h=250&fit=crop" alt="Kansai Pass" class="dashboard-card-image">
              <div class="dashboard-card-content">
                <h4 class="dashboard-card-title">Have Fun in Kansai Pass Attractions</h4>
                <p class="dashboard-card-subtitle">Free cancellation</p>
                <div class="dashboard-card-rating">
                  <span class="dashboard-rating-stars">★★★★☆</span>
                  <span class="dashboard-rating-text">4.7 (1,965) • 109K+ booked</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Profile Section -->
      <div id="profile" class="dashboard-content-section">
        <div class="dashboard-profile-content">
          <div class="dashboard-profile-section-title">
            Profile Information
            <button class="dashboard-edit-profile-btn">
              <i class="fas fa-edit"></i> Edit Profile
            </button>
          </div>

          <div class="dashboard-profile-grid">
            <div class="dashboard-profile-info-card">
              <div class="dashboard-profile-avatar-section">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face" alt="Profile" class="dashboard-profile-avatar-large">
                <div>
                  <div class="dashboard-profile-name">Brian Johnson</div>
                  <div class="dashboard-profile-level-text">Explorer Level</div>
                  <div class="user-profile-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </div>
                </div>
              </div>

              <div class="dashboard-info-row">
                <i class="fas fa-user dashboard-info-icon"></i>
                <div class="dashboard-info-details">
                  <div class="dashboard-info-label">Full Name</div>
                  <div class="dashboard-info-value">Brian Johnson</div>
                </div>
              </div>

              <div class="dashboard-info-row">
                <i class="fas fa-envelope dashboard-info-icon"></i>
                <div class="dashboard-info-details">
                  <div class="dashboard-info-label">Email</div>
                  <div class="dashboard-info-value">brian.johnson@email.com</div>
                </div>
              </div>

              <div class="dashboard-info-row">
                <i class="fas fa-phone dashboard-info-icon"></i>
                <div class="dashboard-info-details">
                  <div class="dashboard-info-label">Phone</div>
                  <div class="dashboard-info-value">+1 (555) 123-4567</div>
                </div>
              </div>

              <div class="dashboard-info-row">
                <i class="fas fa-map-marker-alt dashboard-info-icon"></i>
                <div class="dashboard-info-details">
                  <div class="dashboard-info-label">Location</div>
                  <div class="dashboard-info-value">New York, USA</div>
                </div>
              </div>
            </div>

            <div>
              <div class="dashboard-membership-info-card">
                <h3 class="dashboard-membership-title">Membership Benefits</h3>
                <p class="dashboard-membership-benefits">4 benefits, 1X JCYCash</p>
                <div class="dashboard-klook-cash-amount">1,245 JCYkCash</div>
              </div>

              <div class="dashboard-profile-info-card" style="margin-top: 20px;">
                <div class="dashboard-info-row">
                  <div class="dashboard-info-details">
                    <div class="dashboard-info-label">Member Since</div>
                    <div class="dashboard-info-value">March 2023</div>
                  </div>
                </div>
                <div class="dashboard-info-row">
                  <div class="dashboard-info-details">
                    <div class="dashboard-info-label">Total Bookings</div>
                    <div class="dashboard-info-value">12 trips</div>
                  </div>
                </div>
                <div class="dashboard-info-row">
                  <div class="dashboard-info-details">
                    <div class="dashboard-info-label">Countries Visited</div>
                    <div class="dashboard-info-value">5 countries</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- My Bookings with Data -->
      <div id="my-bookings" class="dashboard-content-section">
        <div class="dashboard-bookings-header">
          <h2 class="dashboard-bookings-title">My Bookings</h2>
          <select class="dashboard-filter-dropdown" onchange="filterDashboardBookings(this.value)">
            <option value="all">All Bookings</option>
            <option value="confirmed">Confirmed</option>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
          </select>
        </div>

        <div id="dashboard-bookings-list">
          <!-- Sample Booking Items -->
          <div class="dashboard-booking-item" data-status="confirmed">
            <div class="dashboard-booking-content">
              <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=300&h=200&fit=crop" alt="Universal Studios" class="dashboard-booking-image">
              <div class="dashboard-booking-details">
                <div class="dashboard-booking-header-info">
                  <div>
                    <div class="dashboard-booking-title">Universal Studios Japan Studio Pass</div>
                    <div class="dashboard-booking-location">Osaka, Japan</div>
                    <div class="dashboard-booking-meta">
                      <span><i class="fas fa-calendar"></i> 2024-08-15</span>
                      <span><i class="fas fa-clock"></i> 09:00 AM</span>
                      <span><i class="fas fa-users"></i> 2 Guests</span>
                    </div>
                  </div>
                  <div style="text-align: right;">
                    <div class="dashboard-booking-price">¥8,400</div>
                    <span class="dashboard-status-badge dashboard-status-confirmed">Confirmed</span>
                  </div>
                </div>

                <div class="dashboard-booking-actions">
                  <div class="dashboard-booking-id">Booking ID: BK001</div>
                  <div class="dashboard-action-buttons">
                    <a href="#" class="dashboard-btn dashboard-btn-primary">
                      <i class="fas fa-eye"></i> View Details
                    </a>
                    <a href="#" class="dashboard-btn dashboard-btn-success">
                      <i class="fas fa-download"></i> Download Ticket
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="dashboard-booking-item" data-status="pending">
            <div class="dashboard-booking-content">
              <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=300&h=200&fit=crop" alt="Tokyo Skytree" class="dashboard-booking-image">
              <div class="dashboard-booking-details">
                <div class="dashboard-booking-header-info">
                  <div>
                    <div class="dashboard-booking-title">Tokyo Skytree Ticket</div>
                    <div class="dashboard-booking-location">Tokyo, Japan</div>
                    <div class="dashboard-booking-meta">
                      <span><i class="fas fa-calendar"></i> 2024-08-20</span>
                      <span><i class="fas fa-clock"></i> 02:00 PM</span>
                      <span><i class="fas fa-users"></i> 1 Guest</span>
                    </div>
                  </div>
                  <div style="text-align: right;">
                    <div class="dashboard-booking-price">¥3,100</div>
                    <span class="dashboard-status-badge dashboard-status-pending">Pending</span>
                  </div>
                </div>

                <div class="dashboard-booking-actions">
                  <div class="dashboard-booking-id">Booking ID: BK002</div>
                  <div class="dashboard-action-buttons">
                    <a href="#" class="dashboard-btn dashboard-btn-primary">
                      <i class="fas fa-eye"></i> View Details
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="dashboard-booking-item" data-status="completed">
            <div class="dashboard-booking-content">
              <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=300&h=200&fit=crop" alt="Kansai Pass" class="dashboard-booking-image">
              <div class="dashboard-booking-details">
                <div class="dashboard-booking-header-info">
                  <div>
                    <div class="dashboard-booking-title">Kansai Pass Attractions</div>
                    <div class="dashboard-booking-location">Kyoto, Japan</div>
                    <div class="dashboard-booking-meta">
                      <span><i class="fas fa-calendar"></i> 2024-07-10</span>
                      <span><i class="fas fa-clock"></i> 10:00 AM</span>
                      <span><i class="fas fa-users"></i> 2 Guests</span>
                    </div>
                  </div>
                  <div style="text-align: right;">
                    <div class="dashboard-booking-price">¥9,300</div>
                    <span class="dashboard-status-badge dashboard-status-completed">Completed</span>
                  </div>
                </div>

                <div class="dashboard-booking-actions">
                  <div class="dashboard-booking-id">Booking ID: BK003</div>
                  <div class="dashboard-action-buttons">
                    <a href="#" class="dashboard-btn dashboard-btn-primary">
                      <i class="fas fa-eye"></i> View Details
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Other Sections -->
      <div id="promo-codes" class="dashboard-content-section">
        <h2>Promo Codes</h2>
        <div class="dashboard-empty-state">
          <div class="dashboard-empty-icon">
            <i class="fas fa-percent"></i>
          </div>
          <h2 class="dashboard-empty-title">No promo codes available</h2>
          <p class="dashboard-empty-subtitle">Check back later for exclusive deals and discounts!</p>
        </div>
      </div>

      <div id="jcy-cash" class="dashboard-content-section">
        <h2>JCYCash</h2>
        <div style="max-width: 500px; margin: 40px auto;">
          <div class="dashboard-membership-info-card">
            <h3 class="dashboard-membership-title">Available Balance</h3>
            <div class="dashboard-klook-cash-amount">1,245 JCYCash</div>
            <p class="dashboard-membership-benefits">Earn more by booking activities and experiences</p>
            <button class="dashboard-btn" style="background: rgba(255,255,255,0.2); color: white; margin-top: 16px;">
              View Transaction History
            </button>
          </div>
        </div>
      </div>

      <div id="reviews" class="dashboard-content-section">
        <h2>Reviews</h2>
        <div class="dashboard-empty-state">
          <div class="dashboard-empty-icon">
            <i class="fas fa-star"></i>
          </div>
          <h2 class="dashboard-empty-title">No reviews yet</h2>
          <p class="dashboard-empty-subtitle">Share your experiences by writing reviews for your completed bookings!</p>
        </div>
      </div>

      <div id="payment" class="dashboard-content-section">
        <h2>Payment Methods</h2>
        <div style="max-width: 600px;">
          <div class="dashboard-booking-item">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <div style="display: flex; align-items: center; gap: 16px;">
                <div style="background: #1976d2; color: white; padding: 8px 12px; border-radius: 6px; font-size: 12px; font-weight: 700;">
                  VISA
                </div>
                <div>
                  <div style="font-weight: 600;">•••• •••• •••• 4242</div>
                  <div style="font-size: 14px; color: #666;">Expires 12/26</div>
                </div>
              </div>
              <div style="display: flex; gap: 12px;">
                <button class="dashboard-btn dashboard-btn-primary">Edit</button>
                <button class="dashboard-btn" style="background: #f44336; color: white;">Remove</button>
              </div>
            </div>
          </div>

          <div style="border: 2px dashed #ddd; border-radius: 12px; padding: 40px; text-align: center; color: #666; cursor: pointer; margin-top: 20px;" onclick="addDashboardPaymentMethod()">
            <i class="fas fa-plus" style="font-size: 24px; margin-bottom: 12px;"></i>
            <div>Add New Payment Method</div>
          </div>
        </div>
      </div>

      <div id="participant" class="dashboard-content-section">
        <h2>Participant Details</h2>
        <div class="dashboard-empty-state">
          <div class="dashboard-empty-icon">
            <i class="fas fa-users"></i>
          </div>
          <h2 class="dashboard-empty-title">No participant details saved</h2>
          <p class="dashboard-empty-subtitle">Save participant information for faster booking next time!</p>
        </div>
      </div>

      <div id="delivery" class="dashboard-content-section">
        <h2>Delivery Details</h2>
        <div class="dashboard-empty-state">
          <div class="dashboard-empty-icon">
            <i class="fas fa-truck"></i>
          </div>
          <h2 class="dashboard-empty-title">No delivery addresses saved</h2>
          <p class="dashboard-empty-subtitle">Add delivery addresses for physical tickets and merchandise!</p>
        </div>
      </div>

      <div id="wishlists" class="dashboard-content-section">
        <h2>Wishlists</h2>
        <div class="dashboard-empty-state">
          <div class="dashboard-empty-icon">
            <i class="fas fa-heart"></i>
          </div>
          <h2 class="dashboard-empty-title">No items in wishlist</h2>
          <p class="dashboard-empty-subtitle">Save your favorite activities and experiences for later!</p>
        </div>
      </div>

      <div id="login-methods" class="dashboard-content-section">
        <h2>Login Methods</h2>
        <div style="max-width: 600px;">
          <div class="dashboard-booking-item">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <div style="display: flex; align-items: center; gap: 16px;">
                <i class="fas fa-envelope" style="font-size: 24px; color: #666;"></i>
                <div>
                  <div style="font-weight: 600;">Email & Password</div>
                  <div style="font-size: 14px; color: #666;">brian.johnson@email.com</div>
                </div>
              </div>
              <button class="dashboard-btn dashboard-btn-primary">Change Password</button>
            </div>
          </div>

          <div class="dashboard-booking-item">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <div style="display: flex; align-items: center; gap: 16px;">
                <i class="fab fa-google" style="font-size: 24px; color: #db4437;"></i>
                <div>
                  <div style="font-weight: 600;">Google Account</div>
                  <div style="font-size: 14px; color: #666;">Connected</div>
                </div>
              </div>
              <button class="dashboard-btn" style="background: #f44336; color: white;">Disconnect</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function showDashboardSection(sectionId) {
      // Hide all content sections
      const sections = document.querySelectorAll('.dashboard-content-section');
      sections.forEach(section => {
        section.classList.remove('section-active');
      });

      // Remove active class from all menu items
      const menuItems = document.querySelectorAll('.nav-menu-item');
      menuItems.forEach(item => {
        item.classList.remove('nav-item-active');
      });

      // Show selected section
      const targetSection = document.getElementById(sectionId);
      if (targetSection) {
        targetSection.classList.add('section-active');
      }

      // Add active class to clicked menu item
      event.target.closest('.nav-menu-item').classList.add('nav-item-active');
    }

    function filterDashboardBookings(status) {
      const bookings = document.querySelectorAll('.dashboard-booking-item');
      bookings.forEach(booking => {
        if (status === 'all' || booking.dataset.status === status) {
          booking.style.display = 'block';
        } else {
          booking.style.display = 'none';
        }
      });
    }

    function bookNow(attraction) {
      alert('Redirecting to booking page for: ' + attraction.replace('-', ' '));
      // Here you would redirect to the actual booking page
    }

    function addDashboardPaymentMethod() {
      alert('Opening add payment method form...');
      // Here you would show a modal or redirect to add payment form
    }

    // Initialize with bookings section active
    document.addEventListener('DOMContentLoaded', function() {
      showDashboardSection('bookings');
    });
  </script>

</main>


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