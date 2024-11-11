// Function to start editing a comment
function editComment(commentID) {
    // Hide the comment text and show the edit form
    document.getElementById(`comment-text-${commentID}`).style.display = 'none';
    document.getElementById(`edit-form-${commentID}`).style.display = 'block';
}

// Function to cancel editing a comment
function cancelEdit(commentID) {
    // Show the comment text and hide the edit form
    document.getElementById(`comment-text-${commentID}`).style.display = 'inline';
    document.getElementById(`edit-form-${commentID}`).style.display = 'none';
}

document.addEventListener("DOMContentLoaded", function () {
    // Select all like icons
    const likeIcons = document.querySelectorAll(".like-icon");

    likeIcons.forEach((likeIcon) => {
        const iconElement = likeIcon.querySelector("ion-icon");

        // Find the closest `.post-likes` element within the same post container
        const postContainer = likeIcon.closest(".post-body"); // Adjust selector if necessary
        const likeCountElement = postContainer.querySelector(".post-likes");

        // Ensure we have a likeCountElement to avoid errors
        if (!likeCountElement) return;

        let liked = false;
        let likes = parseInt(likeCountElement.textContent) || 0; // Get initial likes, default to 0 if not a number

        likeIcon.addEventListener("click", function () {
            liked = !liked;
            if (liked) {
                iconElement.setAttribute("name", "build");
                likeCountElement.textContent = `${++likes} likes`;
                likeIcon.classList.add("active");
            } else {
                iconElement.setAttribute("name", "build-outline");
                likeCountElement.textContent = `${--likes} likes`;
                likeIcon.classList.remove("active");
            }
        });
    });
});

