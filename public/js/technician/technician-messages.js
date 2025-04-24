// Menu Toggle
// Select the HTML element with the class "toggle" and assigns it to the variable toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");
let url = window.location.href; // Stores the current URL
const chatBox = document.querySelector(".chat-box");
const form = document.querySelector(".typing-area");
const inputField = form.querySelector(".input-field");

// This adds a click event handler to the toggle element. When clicked, it toggles the "active" class on both the navigation and main elements
toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};

// Handle form submission, preventing the default form submission behavior
form.onsubmit = (e) => {
    e.preventDefault(); // Prevent default form submission
};

// Fetch user list
document.addEventListener("DOMContentLoaded", () => { // Adds a event listener that runs the following function once the DOM is fully loaded
    const fetchUserList = async () => { // Asynchronous function to retrieve the list of users
        try {
            // Dynamically get the base URL
            let baseUrl = window.location.origin;

            // Construct the endpoint URL
            let apiUrl = `${baseUrl}/technician-messages/load-user-list`;

            const response = await fetch(apiUrl); // Makes an HTTP request to the API endpoint and waits for the response
            if (response.ok) {
                const html = await response.text(); // Extracts the HTML content from the response
                const userListContainer = document.querySelector('.users-list'); // Selects the HTML element with the class "users-list"
                if (userListContainer) { // Checks if the element exists
                    userListContainer.innerHTML = html; // Replaces the inner HTML content of the element with the HTML content from the response
                }
            } else {
                console.error('Failed to fetch user list:', response.statusText);
            }
        } catch (error) {
            console.error('Error fetching user list:', error);
        }
    };

    // Fetch user list every second
    setInterval(fetchUserList, 1000);
});

// Scroll to the bottom of the chat box
function scrollToBottom() {
    chatBox.scrollTo({top: chatBox.scrollHeight, behavior: "smooth"});
}

// Asynchronous function to send a message
async function sendMessage(technicianId, customerId) {
    // Dynamically get the base URL
    let baseUrl = window.location.origin;
    const chatUrl = `${baseUrl}/customer-messages/${customerId}`;

    // This creates a package of information to send: who's sending the message, who's receiving it, and the actual message text
    const payload = {
        outgoing_msg_id: technicianId,
        incoming_msg_id: customerId,
        message: inputField.value,
    };

    console.log('Sending message:', payload);

    try {
        // This makes an HTTP POST request to the chat URL with the payload
        const response = await fetch(chatUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload) // Converts the payload object to a JSON string
        });

        if (response.ok) {
            inputField.value = ""; // If the server responds successfully, clear the input field
            const result = await response.json(); // Converts the response body to a JSON object                                                        
            console.log('Response: ', result);
            scrollToBottom();
        } else {
            inputField.value = "";
            const error = await response.json();
            console.error('Error: ', error);
        }
    } catch (e) {
        inputField.value = "";
        alert('An error occurred while sending the request');
        console.error('Error: ', e);
    }
}

function viewUser(customerId) {
    /* Redirect to the technician profile page */
    window.location.href = `/customer-messages/${customerId}`;
}