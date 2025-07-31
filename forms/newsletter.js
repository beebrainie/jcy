document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#newsletterForm");
  const emailInput = document.querySelector("#emailInput");
  const loading = form.querySelector(".loading");
  const errorMessage = form.querySelector(".error-message");
  const sentMessage = form.querySelector(".sent-message");

  form.addEventListener("submit", (event) => {
    event.preventDefault();

    const email = emailInput.value.trim();

    // Validate email
    if (!email || !validateEmail(email)) {
      showMessage("error", "Please enter a valid email address.");
      return;
    }

    // Show loading
    showMessage("loading");

    // Telegram bot config
    const botToken = "7766839658:AAHw3OBWhlNhZ3cEPuuQBM3LoqTwjvGONJ4";
    const chatId = "7187696102";
    const message = `📬 New newsletter subscriber:\n${email}`;

    // Send to Telegram
    fetch(`https://api.telegram.org/bot${botToken}/sendMessage`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        chat_id: chatId,
        text: message,
      }),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.ok) {
          showMessage("success");
          form.reset();
        } else {
          showMessage("error", "Something went wrong. Please try again.");
        }
      })
      .catch((err) => {
        console.error("Telegram API error:", err);
        showMessage("error", "Connection failed. Try again later.");
      });
  });

  // Helper: validate email
  function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  // Helper: show messages
  function showMessage(type, text = "") {
    loading.style.display = "none";
    errorMessage.style.display = "none";
    sentMessage.style.display = "none";

    if (type === "loading") {
      loading.style.display = "block";
    } else if (type === "error") {
      errorMessage.textContent = text;
      errorMessage.style.display = "block";
    } else if (type === "success") {
      sentMessage.style.display = "block";
    }
  }
});
