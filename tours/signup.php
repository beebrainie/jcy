<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load required classes early for API usage
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// DB config
include '../config/db.php';

// Handle API POST requests (send verification email and final registration)
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($data['action'])) {
  header('Content-Type: application/json');

  if ($mysqli->connect_errno) {
    echo json_encode(['status' => 'error', 'message' => 'DB connection failed: ' . $mysqli->connect_error]);
    exit;
  }

  $action = $data['action'];

  if ($action === 'send_verification_email') {
    $fname = trim($data['fname'] ?? '');
    $lname = trim($data['lname'] ?? '');
    $email = trim($data['email'] ?? '');
    $phone = trim($data['phone'] ?? '');
    $code = trim($data['code'] ?? '');

    if (!$fname || !$lname || !$email || !$phone || !$code) {
      echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
      exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo json_encode(['status' => 'error', 'message' => 'Invalid email format']);
      exit;
    }

    // Delete old pending verification for this email
    $del = $mysqli->prepare("DELETE FROM pending_verifications WHERE email = ?");
    $del->bind_param('s', $email);
    $del->execute();
    $del->close();

    // Insert new pending verification
    $stmt = $mysqli->prepare("INSERT INTO pending_verifications (email, code, fname, lname, phone, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssss", $email, $code, $fname, $lname, $phone);
    $exec = $stmt->execute();
    $stmt->close();

    if (!$exec) {
      echo json_encode(['status' => 'error', 'message' => 'Failed to save verification data']);
      exit;
    }

    try {
      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'sreynairuby@gmail.com';
      $mail->Password = 'rhwz gnqu kqvz rwdh'; // Use env var in production
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->setFrom('sreynairuby@gmail.com', 'JCY Tour');
      $mail->addAddress($email, "$fname $lname");
      $mail->Subject = 'Your Verification Code';
      $mail->Body = "Hi $fname,\n\nYour verification code is: $code\n\nThanks,\nJCY Tour";

      $mail->send();
      echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
      echo json_encode(['status' => 'error', 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
    }

    $mysqli->close();
    exit;
  }

  if ($action === 'final_register') {
    $email = trim($data['email'] ?? '');
    $code = trim($data['code'] ?? '');
    $bookingJson = $data['booking_data'] ?? null;  // <-- New: receive booking data

    if (!$email || !$code) {
      echo json_encode(['status' => 'error', 'message' => 'Email and code required']);
      exit;
    }

    $stmt = $mysqli->prepare("SELECT * FROM pending_verifications WHERE email = ? AND code = ?");
    $stmt->bind_param("ss", $email, $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
      echo json_encode(['status' => 'error', 'message' => 'Invalid code']);
      exit;
    }

    $user = $result->fetch_assoc();
    $stmt->close();

    // 👉 Store user info in session
    $_SESSION['user'] = [
      'first_name' => $user['fname'],
      'last_name' => $user['lname'],
      'email' => $user['email'],
      'phone' => $user['phone'],
    ];

    // 👉 Store booking data in session if available
    if ($bookingJson) {
      $_SESSION['booking_data'] = $bookingJson;
    }

    // 🧹 Delete pending verification record
    $stmt3 = $mysqli->prepare("DELETE FROM pending_verifications WHERE email = ?");
    $stmt3->bind_param("s", $email);
    $stmt3->execute();
    $stmt3->close();

    $mysqli->close();

    // Redirect decision
    $nextPageType = $data['next_page_type'] ?? 'custom';

    if ($nextPageType === 'package') {
      $redirectPage = 'package-booking.php';
    } else {
      $redirectPage = 'custom-booking.php';
    }

    echo json_encode(['status' => 'success', 'redirect' => $redirectPage]);
    exit;
  }
  echo json_encode(['status' => 'error', 'message' => 'Unknown action']);
  exit;
}


// --- Normal GET request: render the signup HTML page ---

header('Content-Type: text/html');
include '../partials/__head.php';
include '../partials/__subhero.php';
?>
<!-- Optional hidden container (not required if not using it) -->
<div id="summaryContainer" style="display: none;"></div>

<script>
  // Ensure the booking data is loaded from localStorage
  window.addEventListener('DOMContentLoaded', () => {
    const booking = JSON.parse(localStorage.getItem('bookingData'));

    // If you want to validate that it's stored, you can log it for debugging
    if (!booking) {
      console.warn("No booking info found in localStorage.");
    } else {
      console.log("Booking data stored:", booking);
      // Nothing else shown to user
    }
  });
</script>


<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.min.css" />
  <style>
    a#resendCodeLink,
    a#backToEditLink {
      text-decoration: none;
      transition: 0.2s ease;
    }

    a#resendCodeLink:hover,
    a#backToEditLink:hover {
      text-decoration: underline;
      opacity: 0.9;
    }

    /* Your CSS styles here (same as you gave) */
    .feature .feature-item .feature-icon {
      background: var(--bs-white);
      border-radius: 10px;
      display: inline-block;
    }

    .page-wrapper {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
      width: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 40px 20px;
      background: linear-gradient(135deg, #f0f2ff 0%, #e6f0ff 100%);
      box-sizing: border-box;
    }

    .regform-container {
      display: flex;
      max-width: 950px;
      width: 100%;
      background-color: #fff;
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(38, 49, 72, 0.15);
      flex-wrap: nowrap;
      transition: box-shadow 0.3s ease;
    }

    .regform-container:hover {
      box-shadow: 0 30px 60px rgba(38, 49, 72, 0.25);
    }

    .regform-left {
      flex: 1 1 50%;
      background: #f7f9ff;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px;
    }

    .regform-left img {
      max-width: 90%;
      height: auto;
      border-radius: 10px;
      filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.08));
    }

    .regform-right {
      flex: 1 1 50%;
      padding: 40px 30px;
      background-color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .regform-right h2 {
      font-size: 26px;
      font-weight: 700;
      margin-bottom: 10px;
      color: #222;
    }

    .regform-group {
      margin-bottom: 18px;
    }

    .regform-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #444;
      font-size: 13px;
      letter-spacing: 0.03em;
    }

    .regform-group input {
      width: 100%;
      padding: 11px 14px;
      border: 1.8px solid #ddd;
      border-radius: 8px;
      font-size: 15px;
      background-color: #fafafa;
      color: #333;
      transition: all 0.2s ease;
    }

    .regform-group input:focus {
      border-color: #6c63ff;
      box-shadow: 0 0 6px rgba(108, 99, 255, 0.3);
      background-color: #fff;
      outline: none;
    }

    .regform-submit-btn {
      width: 100%;
      padding: 13px;
      background: linear-gradient(90deg, #5896ed, #3880f1);
      color: #fff;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s ease;
      margin-top: 10px;
    }

    .regform-submit-btn:hover {
      background: linear-gradient(90deg, #3880f1, #5896ed);
    }

    .regform-social-login {
      text-align: center;
      margin-top: 30px;
    }

    .regform-social-login span {
      color: #777;
      font-size: 13px;
      display: block;
      margin-bottom: 12px;
      font-weight: 500;
    }

    .regform-social-icons {

      display: flex;
      justify-content: center;
      gap: 16px;
    }


    .regform-social-icons a img {

      width: 36px;
      height: 36px;
      border-radius: 50%;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
      box-shadow: 0 2px 16px rgba(0, 0, 0, 0.1);
      padding: 2px;
    }

    .regform-social-icons a img:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    @media (max-width: 900px) {
      .regform-container {
        flex-direction: column;
        max-width: 100%;
      }

      .regform-left,
      .regform-right {
        flex: 1 1 100%;
        padding: 30px 20px;
      }

      .regform-left img {
        max-width: 60%;
      }
    }
  </style>
</head>

<body>

  <div class="page-wrapper">
    <div class="regform-container">
      <div class="regform-left">
        <img src="../assets/img/illustration/sign.png" alt="Registration Illustration" />
      </div>
      <div class="regform-right">
        <div class="feature-icon p-4 mb-4 d-flex justify-content-center align-items-center" style="height: 100px;">
          <img src="../assets/img/illustration/Email (1).gif" alt="Email Icon" style="height: 150px;" class="mx-auto" />
        </div>

        <h2>Register To Continue Booking!</h2>

        <div id="registerForm">
          <form id="userRegisterForm" autocomplete="off" novalidate>

            <div class="regform-group">
              <label for="fname">First Name</label>
              <input type="text" id="fname" name="fname" placeholder="Enter your first name" required />
            </div>
            <div class="regform-group">
              <label for="lname">Last Name</label>
              <input type="text" id="lname" name="lname" placeholder="Enter your last name" required />
            </div>

            <div class="regform-group">
              <label for="phone">Phone Number</label>
              <input id="phone" name="phone" type="tel" placeholder="e.g. +85512345678" required />
            </div>
            <div class="regform-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" placeholder="you@example.com" required />
            </div>
            <button class="regform-submit-btn" type="submit">Register</button>
          </form>
        </div>
        <div id="verifyCodeForm" style="display: none;">
          <h2>Enter the 6-Digit Code</h2>
          <p>We sent a verification code to your email or phone.</p>
          <form id="verifyCodeFormInner" autocomplete="off" novalidate>
            <div class="regform-group">
              <label for="verificationCode">Verification Code</label>
              <input type="text" id="verificationCode" maxlength="6" placeholder="Enter 6-digit code" required />
            </div>
            <button class="regform-submit-btn" type="submit">Verify</button>
          </form>

          <div style="margin-top: 15px; text-align: center;">
            <a href="#" id="resendCodeLink" role="button" tabindex="0" style="color: #6c63ff; font-weight: 600;">🔄 Resend Code</a> |
            <a href="#" id="backToEditLink" role="button" tabindex="0" style="color: #f44336; font-weight: 600;">← Back</a>
          </div>
        </div>

        <div class="regform-social-login">
          <span>Or register with</span>
          <div class="regform-social-icons">
            <a href="#"><img src="../assets/img/icon/Gmail_icon_(2020).svg.png" alt="Gmail" width="30" height="30" /></a>
            <a href="#"><img src="../assets/img/icon/LinkedIn_icon.svg.webp" alt="LinkedIn" width="30" height="30" /></a>
            <a href="#"><img src="../assets/img/icon/Google__G__logo.svg.webp" alt="Google" width="30" height="30" /></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>

  <!-- SUCCESS POPUP HTML -->
  <div id="addToCartSuccessPopup" style="
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      z-index: 9999;
      text-align: center;
      width: 280px;
      font-family: 'Arial', sans-serif;
    ">
    <div style="
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background-color: #4CAF50;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px auto;
      ">
      <span style="font-size: 32px; color: white;">✓</span>
    </div>
    <h3 style="margin: 0; font-size: 18px; color: #333;">Registration Complete</h3>
    <p style="margin-top: 6px; font-weight: bold; color: #4CAF50; font-size: 16px;">Redirecting...</p>
  </div>

  <!-- Popup Alert Box -->
  <div id="customAlertBox" style="
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      padding: 28px;
      border-radius: 14px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      z-index: 9999;
      text-align: center;
      width: 280px;
      font-family: 'Arial', sans-serif;
      ">
    <div id="popupIcon" style="
          width: 60px;
          height: 60px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          margin: 0 auto 16px auto;
          font-size: 28px;
          color: white;
        ">
      !
    </div>
    <h3 id="popupTitle" style="margin: 0; font-size: 18px; color: #333;"></h3>
    <p id="popupMessage" style="margin-top: 6px; font-size: 14px;"></p>
  </div>

  <script>
    // Initialize intl-tel-input
    const input = document.querySelector("#phone");
    const iti = window.intlTelInput(input, {
      preferredCountries: ["kh", "bd", "us"],
      separateDialCode: true,
      initialCountry: "auto",
      geoIpLookup: callback => {
        fetch("https://ipinfo.io/json?token=0793861ca19c7a")
          .then(resp => resp.json())
          .then(resp => callback(resp.country))
          .catch(() => callback("us"));
      },
      utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js"
    });
  </script>

</body>
<script>
  const customTour = JSON.parse(localStorage.getItem('custom_tour_info'));
  document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("userRegisterForm");
    const verifyForm = document.getElementById("verifyCodeFormInner");
    const popup = document.getElementById("addToCartSuccessPopup");

    function generateCode() {
      return Math.floor(100000 + Math.random() * 900000).toString();
    }

    function showPopup(message, type = "info") {
      const popup = document.getElementById("customAlertBox");
      const icon = document.getElementById("popupIcon");
      const title = document.getElementById("popupTitle");
      const text = document.getElementById("popupMessage");

      let bgColor, iconChar, heading;
      switch (type) {
        case "success":
          bgColor = "#4CAF50";
          iconChar = "✓";
          heading = "Success";
          break;
        case "error":
          bgColor = "#f44336";
          iconChar = "✕";
          heading = "Error";
          break;
        default:
          bgColor = "#2196F3";
          iconChar = "ℹ";
          heading = "Notice";
      }

      icon.style.backgroundColor = bgColor;
      icon.textContent = iconChar;
      title.textContent = heading;
      text.textContent = message;
      popup.style.display = "block";
      setTimeout(() => {
        popup.style.display = "none";
      }, 2500);
    }

    form.addEventListener("submit", function(e) {
      e.preventDefault();
      const fname = document.getElementById("fname").value.trim();
      const lname = document.getElementById("lname").value.trim();
      const email = document.getElementById("email").value.trim();
      const phone = iti.getNumber(); // intl-tel-input instance
      const code = generateCode();

      if (!fname || !lname || !email || !phone) {
        showPopup("Please fill in all fields.", "error");
        return;
      }

      const user = {
        action: "send_verification_email",
        fname,
        lname,
        email,
        phone,
        code
      };
      localStorage.setItem("registeredUser", JSON.stringify(user));

      fetch("signup.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(user)
        })
        .then(res => res.json())
        .then(data => {
          if (data.status === "success") {
            showPopup("Verification code sent!", "success");
            document.getElementById("registerForm").style.display = "none";
            document.getElementById("verifyCodeForm").style.display = "block";
          } else {
            showPopup(data.message || "Failed to send email", "error");
          }
        }).catch(() => showPopup("Network error sending code", "error"));
    });

    verifyForm.addEventListener("submit", function(e) {
      e.preventDefault();
      const inputCode = document.getElementById("verificationCode").value.trim();
      const user = JSON.parse(localStorage.getItem("registeredUser"));

      if (!user || !inputCode) {
        showPopup("Missing user or code", "error");
        return;
      }

      const nextPageType = localStorage.getItem("nextBookingPage") || "custom";
      const bookingData = localStorage.getItem("bookingData") || null; // <--- Get booking data here

      fetch("signup.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            action: "final_register",
            email: user.email,
            code: inputCode,
            next_page_type: nextPageType,
            booking_data: bookingData // <--- Send booking data here
          })
        })
        .then(res => res.json())
        .then(data => {
          if (data.status === "success") {
            popup.style.display = "block";
            setTimeout(() => {
              window.location.href = data.redirect;
            }, 2000);
          } else {
            showPopup(data.message || "Verification failed", "error");
          }
        })
        .catch(() => {
          showPopup("Network error verifying code", "error");
        });
    });

    document.getElementById("resendCodeLink").addEventListener("click", e => {
      e.preventDefault();
      document.getElementById("verifyCodeForm").style.display = "none";
      document.getElementById("registerForm").style.display = "block";
    });

    document.getElementById("backToEditLink").addEventListener("click", e => {
      e.preventDefault();
      document.getElementById("verifyCodeForm").style.display = "none";
      document.getElementById("registerForm").style.display = "block";
    });
  });
</script>

<div id="summaryContainer" class="container mt-5"></div>







<?php include '../partials/__footer.php' ?>

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