// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");
let url = window.location.href;
const chatBox = document.querySelector(".chat-box");
const chatArea = document.querySelector(".chat-area");
const form = document.querySelector(".typing-area");
const inputField = form.querySelector(".input-field");

document.addEventListener("DOMContentLoaded", function () {
    const checkAllBtn = document.querySelector(".mailbox-controls .btn.default-btn");
    const checkboxes = document.querySelectorAll(".mailbox-messages input[type='checkbox']");

    checkAllBtn.addEventListener("click", function () {
        checkboxes.forEach(checkbox => {
            checkbox.checked = !checkbox.checked;
        });
    });
});

toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};

// Handle form submission
form.onsubmit = (e) => {
    e.preventDefault(); // Prevent default form submission
};

document.addEventListener("DOMContentLoaded", () => {
    const fetchUserList = async () => {
        try {
            // Dynamically get the base URL
            let baseUrl = window.location.origin;
            // Construct the endpoint URL
            let apiUrl = `${baseUrl}/customer-messages/load-user-list`;

            const response = await fetch(apiUrl);
            if (response.ok) {
                const html = await response.text();
                const userListContainer = document.querySelector('.users-list');
                if (userListContainer) {
                    userListContainer.innerHTML = html;
                }
            } else {
                console.error('Failed to fetch user list:', response.statusText);
            }
        } catch (error) {
            console.error('Error fetching user list:', error);
        }
    };

    // Fetch user list every 2 seconds
    setInterval(fetchUserList, 1000);
});

// Function to fetch chat messages and update the chat-box
const fetchMessages = async () => {
    try {
        // Extract customer ID from the current URL
        const url = window.location.href;
        const id = url.split('/').pop();
        const path = `/technician-messages/${id}/load-messages`;

        // Fetch messages from the server
        const response = await fetch(path);

        if (response.ok) {
            const chatContent = await response.text();

            // Update the .chat-box content
            chatArea.innerHTML = chatContent;

            // Scroll to the bottom if chatArea is not active
            if (!chatArea.classList.contains("active")) {
                scrollToBottom();
            }
        } else {
            console.error(`Failed to fetch messages: ${response.statusText}`);
        }
    } catch (error) {
        console.error(`Error fetching messages: ${error.message}`);
    }
};

// Automatically fetch messages at regular intervals
//setInterval(fetchMessages, 1000); // Fetch every 1000 milliseconds


function viewUser(technicianId) {
    /* Redirect to the technician profile page */
    window.location.href = `/technician-messages/${technicianId}`;
}

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}