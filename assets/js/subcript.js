const text = document.querySelector("#text");
const form = document.querySelector("#newsletterForm");

form.addEventListener("submit", (event) => {
  event.preventDefault();

  console.log(text.value);

  const botToken = "7643496469:AAHeBM_vQLSDZNFbZLMjwF1GCqsXXpHk0OQ";
  const chatId = "5837857222";
  const message = `New subscription: ${text.value}`;

  const apiUrl = `https://api.telegram.org/bot${botToken}/sendMessage`;
  fetch(apiUrl, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      chat_id: chatId,
      text: message,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.ok) {
        // alert("Thank you for subscribing!");
        form.reset();
      } else {
        alert("Failed to send your subscription. Please try again.");
      }
      console.log("Message sent successfully:", data);
    })
    .catch((error) => {
      console.error("Error sending message:", error);
      alert("An error occurred. Please try again later.");
    });
});
