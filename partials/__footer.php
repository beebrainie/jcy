<footer id="footer" class="footer position-relative dark-background">
    <div class="footer-newsletter">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6">
                    <h4>Join Our Newsletter</h4>
                    <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
                    <form id="newsletterForm-alt" novalidate>
                        <div class="newsletter-form">
                            <input
                                type="email"
                                name="email"
                                id="emailInput-alt"
                                class="email-input"
                                placeholder="Your email address"
                                required
                                aria-describedby="errorMessage-alt sentMessage-alt" />
                            <input type="submit" value="Subscribe" />
                        </div>

                        <div class="loading" style="display: none;" aria-live="polite">Loading...</div>
                        <div class="error-message" style="display: none;" id="errorMessage-alt" aria-live="assertive"></div>
                        <div class="sent-message" style="display: none;" id="sentMessage-alt" aria-live="polite">
                            Your subscription request has been sent. Thank you!
                        </div>
                    </form>

                    <script>
                        (function() {
                            document.addEventListener("DOMContentLoaded", () => {
                                const form = document.querySelector("#newsletterForm-alt");
                                if (!form) return;

                                const emailInput = form.querySelector("#emailInput-alt");
                                const loading = form.querySelector(".loading");
                                const errorMessage = form.querySelector(".error-message");
                                const sentMessage = form.querySelector(".sent-message");

                                let isSubmitting = false;

                                form.addEventListener("submit", async (event) => {
                                    event.preventDefault();

                                    if (isSubmitting) return; // prevent multiple submits
                                    hideAllMessages();

                                    const email = emailInput.value.trim();

                                    if (!validateEmail(email)) {
                                        showMessage("error", "Please enter a valid email address.");
                                        return;
                                    }

                                    showMessage("loading");
                                    isSubmitting = true;

                                    const botToken = "7766839658:AAHw3OBWhlNhZ3cEPuuQBM3LoqTwjvGONJ4";
                                    const chatId = "7187696102";
                                    const message = `📬 New newsletter subscriber:\n${email}`;

                                    try {
                                        const res = await fetch(`https://api.telegram.org/bot${botToken}/sendMessage`, {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/json",
                                            },
                                            body: JSON.stringify({
                                                chat_id: chatId,
                                                text: message,
                                            }),
                                        });
                                        const data = await res.json();

                                        loading.style.display = "none";
                                        isSubmitting = false;

                                        if (data.ok) {
                                            showMessage("success");
                                            form.reset();
                                            console.log("Telegram message sent successfully.");
                                        } else {
                                            showMessage("error", "Something went wrong. Please try again.");
                                            console.error("Telegram API response error:", data);
                                        }
                                    } catch (err) {
                                        loading.style.display = "none";
                                        isSubmitting = false;
                                        showMessage("error", "Connection failed. Try again later.");
                                        console.error("Telegram API fetch error:", err);
                                    }
                                });

                                function validateEmail(email) {
                                    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                                }

                                function showMessage(type, text = "") {
                                    hideAllMessages();
                                    if (type === "loading") {
                                        loading.style.display = "block";
                                    } else if (type === "error") {
                                        errorMessage.textContent = text;
                                        errorMessage.style.display = "block";
                                    } else if (type === "success") {
                                        sentMessage.style.display = "block";
                                    }
                                }

                                function hideAllMessages() {
                                    loading.style.display = "none";
                                    errorMessage.style.display = "none";
                                    sentMessage.style.display = "none";
                                    errorMessage.textContent = "";
                                }
                            });
                        })();
                    </script>

                </div>
            </div>
        </div>
    </div>
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="index.html" class="d-flex align-items-center">
                    <span class="sitename">Tour</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>Prey Vor-Moc Hoa Border, Au Village, Thmei Commune, Kampong Rou District, Svay Rieng Province, Cambodia.</p>
                    <p class="mt-3"><strong>Phone:</strong> <span> (+855) 97 559 0178</span></p>
                    <p><strong>Email:</strong> <span>sales@jcytour.com</span></p>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="/index.php">Home</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="/about.php">About us</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li> <a href="#">FLIGHT TICKETS</a></li>
                    <li> <a href="#">HOTEL RESERVATION </a></li>
                    <li> <a href="#">TRANSPORT RESERVATION</a></li>
                    <li> <a href="#">TRAVEL INSURANCE </a></li>
                    <li><a href="#">PASSPORT & VISA</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-12">
                <h4>Follow Us</h4>
                <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                <div class="social-links d-flex">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">JCY TOUR</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
            Designed by <a href="#">JCY Tour Web Developer</a>
        </div>
    </div>

</footer>

<!-- <script src="/forms/newsletter.js" defer></script> -->