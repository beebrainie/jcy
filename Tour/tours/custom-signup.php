<?php
    // signup.php
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
          $mail->Password = 'rhwz gnqu kqvz rwdh'; // Your app password here - use env var in real use
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

        $stmt2 = $mysqli->prepare("INSERT INTO customers (first_name, last_name, email, phone, address, created_at) VALUES (?, ?, ?, ?, '', NOW())");
        $stmt2->bind_param("ssss", $user['fname'], $user['lname'], $user['email'], $user['phone']);
        $exec2 = $stmt2->execute();
        $stmt2->close();

        if (!$exec2) {
          echo json_encode(['status' => 'error', 'message' => 'Registration failed: ' . $mysqli->error]);
          exit;
        }

        $stmt3 = $mysqli->prepare("DELETE FROM pending_verifications WHERE email = ?");
        $stmt3->bind_param("s", $email);
        $stmt3->execute();
        $stmt3->close();

        $mysqli->close();
        echo json_encode(['status' => 'success']);
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

<script>
  const sendCodeBtn = document.getElementById('send-code-btn');
  const verifyBtn = document.getElementById('verify-btn');
  const backBtn = document.getElementById('back-btn');
  const messageEl = document.getElementById('message');
  const userDetailsSection = document.getElementById('user-details-section');
  const verificationSection = document.getElementById('verification-section');

  // Show booking summary from localStorage
  const bookingData = JSON.parse(localStorage.getItem('bookingData'));
  if (bookingData) {
    document.getElementById('tourName').innerText = bookingData.tour_name || '';
    document.getElementById('tourDate').innerText = bookingData.tour_date || '';
    document.getElementById('totalPrice').innerText = '$' + (bookingData.total_price || 0).toFixed(2);
    document.getElementById('booking-summary').style.display = 'block';
  }

  function randomCode() {
    return Math.floor(100000 + Math.random() * 900000).toString(); // 6-digit code
  }

  // Send Verification Code
  sendCodeBtn.addEventListener('click', async () => {
    messageEl.innerText = '';
    const fname = document.getElementById('fname').value.trim();
    const lname = document.getElementById('lname').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();

    if (!fname || !lname || !email || !phone) {
      messageEl.style.color = 'red';
      messageEl.innerText = 'Please fill all required fields.';
      return;
    }

    const code = randomCode();

    // Send to backend
    try {
      const res = await fetch('signup.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          action: 'send_verification_email',
          fname,
          lname,
          email,
          phone,
          code
        })
      });
      const data = await res.json();
      if (data.status === 'success') {
        messageEl.style.color = 'green';
        messageEl.innerText = 'Verification code sent! Please check your email.';
        userDetailsSection.style.display = 'none';
        verificationSection.style.display = 'block';
        // Save email & code locally for verification step
        localStorage.setItem('signupEmail', email);
        localStorage.setItem('signupCode', code);
      } else {
        messageEl.style.color = 'red';
        messageEl.innerText = data.message || 'Failed to send verification code.';
      }
    } catch (err) {
      messageEl.style.color = 'red';
      messageEl.innerText = 'Error sending verification code. Try again.';
      console.error(err);
    }
  });

  // Verify code and register
  verifyBtn.addEventListener('click', async () => {
    messageEl.innerText = '';
    const email = localStorage.getItem('signupEmail');
    const correctCode = localStorage.getItem('signupCode');
    const inputCode = document.getElementById('verification-code').value.trim();

    if (!inputCode) {
      messageEl.style.color = 'red';
      messageEl.innerText = 'Please enter the verification code.';
      return;
    }

    if (inputCode !== correctCode) {
      messageEl.style.color = 'red';
      messageEl.innerText = 'Incorrect verification code.';
      return;
    }

    try {
      const res = await fetch('signup.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          action: 'final_register',
          email,
          code: inputCode
        })
      });
      const data = await res.json();
      if (data.status === 'success') {
        messageEl.style.color = 'green';
        messageEl.innerText = 'Registration successful! Redirecting...';

        // Clear localStorage codes
        localStorage.removeItem('signupCode');
        localStorage.removeItem('signupEmail');

        // Now send booking data to backend (optional)
        if (bookingData) {
          await fetch('save-booking-after-signup.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(bookingData)
          });
          localStorage.removeItem('bookingData');
        }

        // Redirect after 2 seconds
        setTimeout(() => {
          window.location.href = 'booking-confirmation.php'; // Change to your confirmation page
        }, 2000);
      } else {
        messageEl.style.color = 'red';
        messageEl.innerText = data.message || 'Registration failed.';
      }
    } catch (err) {
      messageEl.style.color = 'red';
      messageEl.innerText = 'Error during registration. Try again.';
      console.error(err);
    }
  });

  // Back button to re-enter user info
  backBtn.addEventListener('click', () => {
    messageEl.innerText = '';
    verificationSection.style.display = 'none';
    userDetailsSection.style.display = 'block';
  });
</script>

<body>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
    <div class="page-wrapper">
      <div class="regform-container">
        <div class="regform-left">
          <img src="../assets/img/illustration/registers.png" alt="Registration Illustration" />
        </div>
        <div class="regform-right">
          <div class="feature-icon p-4 mb-4 d-flex justify-content-center align-items-center" style="height: 100px;">
            <img src="../assets/img/illustration/email.gif" alt="Email Icon" style="height: 150px;" class="mx-auto" />
          </div>

          <h2>Register To Continue Booking!</h2>

          <div id="registerForm">
            <form id="userRegisterForm" autocomplete="off">

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
                <input id="phone" name="phone" type="tel" required />
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
            <form id="verifyCodeFormInner" autocomplete="off">
              <div class="regform-group">
                <label for="verificationCode">Verification Code</label>
                <input type="text" id="verificationCode" maxlength="6" placeholder="Enter 6-digit code" required />
              </div>
              <button class="regform-submit-btn" type="submit">Verify</button>
            </form>

            <div style="margin-top: 15px; text-align: center;">
              <a href="#" id="resendCodeLink" style="color: #6c63ff; font-weight: 600;">🔄 Resend Code</a> |
              <a href="#" id="backToEditLink" style="color: #f44336; font-weight: 600;">← Back</a>
            </div>
          </div>


          <div class="regform-social-login">
            <span>Or register with</span>
            <div class="regform-social-icons">
              <a href="#"><img src="../assets/img/icon/Gmail_icon_(2020).svg.png" alt="Facebook" width="30" height="30" /></a>
              <a href="#"><img src="../assets/img/icon/LinkedIn_icon.svg.webp" alt="LinkedIn" width="30" height="30" /></a>
              <a href="#"><img src="../assets/img/icon/Google__G__logo.svg.webp" alt="Google" width="30" height="30" /></a>
            </div>
          </div>
        </div>
      </div>
    </div>
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
    
      <div id="custom-toast" style="
          display: none;
          position: fixed;
          top: 20px;
          left: 50%;
          transform: translateX(-50%);
          background: #dff0d8;
          color: #3c763d;
          padding: 1rem 1.5rem;
          border-radius: 8px;
          box-shadow: 0 4px 12px rgba(0,0,0,0.15);
          font-weight: 600;
          z-index: 9999;">
    </div>

    <script>
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

        function generateCode() {
          return Math.floor(100000 + Math.random() * 900000).toString();
        }

        document.getElementById("userRegisterForm").addEventListener("submit", function(e) {
          e.preventDefault();

          const fname = document.getElementById("fname").value.trim();
          const lname = document.getElementById("lname").value.trim();
          const email = document.getElementById("email").value.trim();
          const phone = iti.getNumber();

          if (!fname || !lname || !email || !phone) {
            alert("Please fill in all fields.");
            return;
          }

          const verificationCode = generateCode();
          const userData = {
            action: "send_verification_email",
            fname,
            lname,
            email,
            phone,
            code: verificationCode
          };

          fetch("", {
              method: "POST",
              headers: {
                "Content-Type": "application/json"
              },
              body: JSON.stringify(userData)
            })
            .then(res => res.json())
            .then(response => {
              if (response.status === "success") {
                localStorage.setItem("registeredUser", JSON.stringify(userData));

                showPopup("Verification code sent to your email.", "success");

                document.getElementById("registerForm").style.display = "none";
                document.getElementById("verifyCodeForm").style.display = "block";
              } else {
                showPopup("Failed to send email: " + response.message, "error");
              }
            })

            .catch(err => {
              console.error("Error sending email:", err);
              alert("Something went wrong sending the verification code.");
            });
        });

        document.getElementById("verifyCodeFormInner").addEventListener("submit", function(e) {
          e.preventDefault();

          const inputCode = document.getElementById("verificationCode").value.trim();
          const storedUser = JSON.parse(localStorage.getItem("registeredUser"));

          if (!storedUser || !inputCode) {
            alert("Session expired or code empty.");
            return;
          }

          const requestData = {
            action: "final_register",
            email: storedUser.email,
            code: inputCode
          };

          fetch("", {
              method: "POST",
              headers: {
                "Content-Type": "application/json"
              },
              body: JSON.stringify(requestData)
            })
            .then(res => res.json())
            .then(data => {
              if (data.status === "success") {
                document.getElementById("verifyCodeForm").style.display = "none";
                const popup = document.getElementById("addToCartSuccessPopup");
                popup.style.display = "block";

                localStorage.removeItem("registeredUser");
                setTimeout(() => {
                  window.location.href = "booking.php";
                }, 2000);
              } else {
                showPopup("❌ " + data.message, "error");
              }
            })

            .catch(err => {
              console.error("Verification error:", err);
              alert("An error occurred while verifying.");
            });
        });

        function showToast(message) {
          const toast = document.getElementById('custom-toast');
          toast.textContent = message;
          toast.style.display = 'block';
          setTimeout(() => {
            toast.style.display = 'none';
          }, 2500);
        }

        // Trigger this when the code is successfully sent
        function sendVerification() {
          const email = document.getElementById("email").value;

          fetch("actions/email-action.php", {
              method: "POST",
              headers: {
                "Content-Type": "application/json"
              },
              body: JSON.stringify({
                email
              })
            })
            .then(res => res.json())
            .then(data => {
              if (data.status === "success") {
                showToast("✅ Verification code sent to your email.");
                setTimeout(() => {
                  window.location.href = "booking.php";
                }, 2000);
              } else {
                showToast("❌ " + data.message);
              }
            })
            .catch(err => {
              showToast("❌ Failed to send email. Try again.");
              console.error(err);
            });
        }

        document.getElementById("resendCodeLink").addEventListener("click", function(e) {
          e.preventDefault();

          const storedUser = JSON.parse(localStorage.getItem("registeredUser"));
          if (!storedUser) {
            showPopup("Missing user data.", "error");
            return;
          }

          // Generate a new code and update localStorage
          const newCode = generateCode();
          storedUser.code = newCode;
          localStorage.setItem("registeredUser", JSON.stringify(storedUser));

          fetch("", {
              method: "POST",
              headers: {
                "Content-Type": "application/json"
              },
              body: JSON.stringify({
                action: "send_verification_email",
                fname: storedUser.fname,
                lname: storedUser.lname,
                email: storedUser.email,
                phone: storedUser.phone,
                code: newCode
              })
            })
            .then(res => res.json())
            .then(data => {
              if (data.status === "success") {
                showPopup("New code sent to your email.", "success");
              } else {
                showPopup("Failed to resend code: " + data.message, "error");
              }
            })
            .catch(err => {
              console.error(err);
              showPopup("Something went wrong resending the code.", "error");
            });
        });

        document.getElementById("backToEditLink").addEventListener("click", function(e) {
          e.preventDefault();

          const storedUser = JSON.parse(localStorage.getItem("registeredUser"));
          if (storedUser) {
            document.getElementById("fname").value = storedUser.fname;
            document.getElementById("lname").value = storedUser.lname;
            document.getElementById("email").value = storedUser.email;
            iti.setNumber(storedUser.phone);
          }

          // Show form again
          document.getElementById("registerForm").style.display = "block";
          document.getElementById("verifyCodeForm").style.display = "none";
        });
    </script>

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
    </script>
</body>




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
      background: linear-gradient(90deg, #6c63ff, #574bff);
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
      background: linear-gradient(90deg, #574bff, #6c63ff);
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