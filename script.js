async function loadHistory() {
    const res = await fetch("chatbot.php");
    const chat = await res.json();
    chat.forEach(msg => {
        appendMessage("user", msg.user);
        appendMessage("bot", msg.bot);
    });
}

function appendMessage(sender, text) {
    const messagesDiv = document.getElementById("messages");
    const msg = document.createElement("div");
    msg.className = "message " + sender;
    msg.innerText = text;
    messagesDiv.appendChild(msg);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
}

function sendMessage() {
    let input = document.getElementById("userInput");
    let message = input.value.trim();
    if (message === "") return;

    appendMessage("user", message);
    input.value = "";

    fetch("chatbot.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "message=" + encodeURIComponent(message)
    })
    .then(res => res.text())
    .then(reply => appendMessage("bot", reply))
    .catch(() => appendMessage("bot", "Error connecting to server."));
}

loadHistory();
