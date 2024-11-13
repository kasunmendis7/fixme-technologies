// Function to start editing a comment
function editComment(commentID) {
    document.getElementById(`comment-text-${commentID}`).style.display = 'none';
    document.getElementById(`edit-form-${commentID}`).style.display = 'block';
}

// Function to cancel editing a comment
function cancelEdit(commentID) {
    document.getElementById(`comment-text-${commentID}`).style.display = 'inline';
    document.getElementById(`edit-form-${commentID}`).style.display = 'none';
}

document.addEventListener("DOMContentLoaded", function () {
    // Like button AJAX functionality
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const postId = this.getAttribute('data-post-id');
            const isLiked = this.getAttribute('data-liked') === 'true';
            const actionUrl = isLiked ? '/post-unlike' : '/post-like';

            fetch(actionUrl, {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: new URLSearchParams({post_id: postId})
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update like state and count display
                        this.setAttribute('data-liked', isLiked ? 'false' : 'true');
                        this.querySelector('ion-icon').setAttribute('name', isLiked ? 'build-outline' : 'build');

                        // Update the like count
                        const likeCountElement = document.querySelector(`.like-count[data-post-id="${postId}"]`);
                        likeCountElement.textContent = `${data.like_count} ${data.like_count === 1 ? 'like' : 'likes'}`;
                    } else {
                        console.error('Failed to update like status');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
});


document.querySelectorAll('.like-button').forEach(button => {
    button.addEventListener('click', function () {
        const postId = this.dataset.postId;
        fetch('/post/like', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({post_id: postId}),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.textContent = `Liked (${data.like_count})`;
                } else {
                    alert('Could not like the post. Please try again.');
                }
            });
    });
});

