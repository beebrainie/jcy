const submitButton = document.getElementById("submitContactForm");
const contactForm = document.getElementById("contactFormUnique");
const successMessage = document.getElementById("successMessage");

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function showError(input, message) {
  const errorDiv = input.parentElement.querySelector(".invalid-feedback");
  errorDiv.textContent = message;
  errorDiv.style.display = "block";
  input.classList.add("is-invalid");
}

function clearError(input) {
  const errorDiv = input.parentElement.querySelector(".invalid-feedback");
  errorDiv.textContent = "";
  errorDiv.style.display = "none";
  input.classList.remove("is-invalid");
}

submitButton.addEventListener("click", async function () {
  const nameInput = document.getElementById("name");
  const emailInput = document.getElementById("email");
  const subjectInput = document.getElementById("subject");
  const messageInput = document.getElementById("message");

  const inputs = [nameInput, emailInput, subjectInput, messageInput];
  inputs.forEach(clearError);

  if (!nameInput.value.trim()) {
    showError(nameInput, "Please enter your name.");
    nameInput.focus();
    return;
  }

  if (!emailInput.value.trim()) {
    showError(emailInput, "Please enter your email.");
    emailInput.focus();
    return;
  }

  if (!isValidEmail(emailInput.value.trim())) {
    showError(emailInput, "Please enter a valid email address.");
    emailInput.focus();
    return;
  }

  if (!subjectInput.value.trim()) {
    showError(subjectInput, "Please enter the subject.");
    subjectInput.focus();
    return;
  }

  if (!messageInput.value.trim()) {
    showError(messageInput, "Please enter your message.");
    messageInput.focus();
    return;
  }

  // TELEGRAM CONFIG
  const botToken = "7766839658:AAHw3OBWhlNhZ3cEPuuQBM3LoqTwjvGONJ4";
  const chatId = "7187696102";
  const text = `📨 New Contact Submission:
👤 Name: ${nameInput.value}
📧 Email: ${emailInput.value}
📝 Subject: ${subjectInput.value}
💬 Message: ${messageInput.value}`;

  const telegramURL = `https://api.telegram.org/bot${botToken}/sendMessage`;

  try {
    const response = await fetch(telegramURL, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ chat_id: chatId, text }),
    });

    const result = await response.json();

    if (response.ok) {
      contactForm.reset();
      successMessage.style.display = "block";
      setTimeout(() => {
        successMessage.style.display = "none";
      }, 3000);
    } else {
      alert("❌ Telegram Error: " + (result.description || "Unknown error."));
    }
  } catch (error) {
    alert("❌ Failed to send. Please try again.");
    console.error(error);
  }
});
