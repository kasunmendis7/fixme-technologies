// Function to start editing a comment
function editComment(commentID) {
    // Hides the text of the comment by getting the element with an ID that includes the commentID and setting its display to none
    document.getElementById(`comment-text-${commentID}`).style.display = 'none';
    // Shows the edit form for the comment by getting the element with an ID that includes the commentID and setting its display style to block
    document.getElementById(`edit-form-${commentID}`).style.display = 'block';
}

// Function to cancel editing a comment
function cancelEdit(commentID) {
    // Make the comment text visible again by setting its display style to inline
    document.getElementById(`comment-text-${commentID}`).style.display = 'inline';
    // Hides the edit form by setting its display style to none
    document.getElementById(`edit-form-${commentID}`).style.display = 'none';
}

// This adds event listener that will execute the provided function once the Document Object Model is fully loaded
document.addEventListener("DOMContentLoaded", function () {
    // Select all the elements with the class 'like-button' and loops through each one
    document.querySelectorAll('.like-button').forEach(button => {
        // For each like button, adds a click event listener-a function that runs when the button is clicked
        button.addEventListener('click', function (event) {
            // Prevent the default action of the button click (such as submission or page navigation)
            event.preventDefault();
            // This retrieves the post ID from the 'data-post-id' attribute of the clicked button
            const postId = this.getAttribute('data-post-id');
            // Checks if the post is already liked by getting the 'data-liked' attribute and comparing it to 'true'
            const isLiked = this.getAttribute('data-liked') === 'true';
            // This sets the appropriate URL for the AJAX request based on whether the post is already liked or not
            const actionUrl = isLiked ? '/post-unlike' : '/post-like';

            // This initiates the AJAX request to the determined URL
            fetch(actionUrl, {
                method: 'POST', // Specifies that it is a post request
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded' // Sets the request header to indicate that the data is being in the URL-encoded format
                },
                body: new URLSearchParams({post_id: postId}) // Creates the request body with post ID, formatted as URL parameters
            })
                .then(response => { // Begins a promise chain to handle the response
                    if (!response.ok) { // Checks if the response was successful
                        throw new Error('Network response was not ok'); // Throws an error if not
                    }
                    return response.json(); // Converts the response to JSON and returns it
                })
                .then(data => { // Handles the JSON data from the response
                    if (data.success) { // Checks if the operation was successful
                        // Update like state and icon
                        this.setAttribute('data-liked', isLiked ? 'false' : 'true');
                        // Changes the name attribute of the icon element inside the button to show either a filled or outlined build icon
                        this.querySelector('ion-icon').setAttribute('name', isLiked ? 'build-outline' : 'build');

                        // Update the like count in the DOM
                        const likeCountElement = document.querySelector(`.like-count[data-post-id="${postId}"]`);
                        // Updates the text content of the like count element with the new count from the server response, using singular or plural form as appropriate
                        likeCountElement.textContent = `${data.like_count} ${data.like_count === 1 ? 'like' : 'likes'}`;
                    } else {
                        console.error('Failed to update like status'); // Logs an error message
                    }
                })
                .catch(error => console.error('Error:', error)); // Logs any errors
        });
    });
});
