/* Sign Out Overlay inside the customer dashboard */
const signOutBtn = document.getElementById("signOutBtn");
const signOutOverlay = document.getElementById("signOutOverlay");
const confirmSignOut = document.getElementById("confirmSignOut");
const cancelSignOut = document.getElementById("cancelSignOut");

// Show the overlay when "Sign Out" button is clicked
signOutBtn.addEventListener("click", (e) => {
    e.preventDefault(); // Prevent the default link action
    signOutOverlay.style.display = "flex"; // Show the overlay
});

// Hide the overlay and proceed with sign-out when "Yes" is clicked
confirmSignOut.addEventListener("click", () => {
    // Add your sign-out logic here, such as redirecting to a logout route
    window.location.href = "/service-center-logout"; // Replace with your logout path
});

// Hide the overlay when "No" is clicked
cancelSignOut.addEventListener("click", () => {
    signOutOverlay.style.display = "none"; // Hide the overlay
});