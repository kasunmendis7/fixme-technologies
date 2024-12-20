// Selecting form, input fields, button, and chatBox
const form = document.querySelector(".typing-area");
const inputField = form.querySelector(".input-field");
const outgoingId = form.querySelector(".outgoing_id");
const incomingId = form.querySelector(".incoming_id");
const sendBtn = form.querySelector("button");
const chatBox = document.querySelector(".chat-box");

// Handle form submission
form.onsubmit = (e) => {
    e.preventDefault(); // Prevent default form submission
};

// Send message on button click
sendBtn.onclick = () => {
    let url = window.location.href; // Current URL to extract customer ID
    let id = url.split('/').pop(); // Extract customer ID from URL
    let path = `/customer-messages/${id}`;

    // Create a new XMLHttpRequest
    const xhr = new XMLHttpRequest();

    // Set the request URL and method
    xhr.open("POST", path, true);


    // Create JSON payload
    const payload = JSON.stringify({
        outgoing_id: outgoingId.value,
        incoming_id: id, // Extracted from URL
        message: inputField.value, // Message from input field
    });


    // Set request headers
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = ""; // once message inserted into the database then leave the input field blank
                scrollToBottom();
            }
        }
    }
    inputField.value = ""; // Clear input field after sending the message
    // Send the request with JSON data
    xhr.send(payload);
};


chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}


// Function to fetch chat messages and update the chat-box
const fetchMessages = () => {
    // Create a new XMLHttpRequest
    const xhr = new XMLHttpRequest();
    let url = window.location.href; // Current URL to extract customer ID
    let id = url.split('/').pop();
    let path = `/customer-messages/${id}/load-messages`

    // Set the request URL for fetching messages
    xhr.open("GET", path, true);

    // Define the onload callback
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = xhr.responseText;

                // Update the .chat-box content
                chatBox.innerHTML = response;

                // Scroll to the bottom if chatBox is not active
                if (!chatBox.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    };

    // Send the request
    xhr.send();
};

// Automatically fetch messages at regular intervals
setInterval(fetchMessages, 500); // Fetch every 1 second

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}

function viewChat(customerId) {
    /* Redirect to the technician profile page */
    window.location.href = `/customer-messages/${customerId}`;
}