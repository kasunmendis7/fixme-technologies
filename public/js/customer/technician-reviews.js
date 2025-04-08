document.addEventListener("DOMContentLoaded", function () {
    var rating_data = 0;

    // Show and hide modal functions
    function showModal() {
        document.getElementById('review_modal').style.display = 'block';
    }

    function hideModal() {
        document.getElementById('review_modal').style.display = 'none';
    }

    // Open modal when "TechnicianReview" button is clicked
    document.getElementById('add_review').addEventListener('click', showModal);
    // Close modal when close button is clicked
    document.getElementById('modal_close').addEventListener('click', hideModal);

    // Function to reset the star background in the modal
    function reset_background() {
        for (var count = 1; count <= 5; count++) {
            var star = document.getElementById('submit_star_' + count);
            star.classList.add('star-light');
            star.classList.remove('text-warning');
        }
    }

    // Add events for each star in the modal
    var submitStars = document.querySelectorAll('.submit_star');
    submitStars.forEach(function (star) {
        star.addEventListener('mouseenter', function () {
            var rating = parseInt(this.getAttribute('data-rating'));
            reset_background();
            for (var count = 1; count <= rating; count++) {
                var currentStar = document.getElementById('submit_star_' + count);
                currentStar.classList.remove('star-light');
                currentStar.classList.add('text-warning');
            }
        });
        star.addEventListener('mouseleave', function () {
            reset_background();
            for (var count = 1; count <= rating_data; count++) {
                var currentStar = document.getElementById('submit_star_' + count);
                currentStar.classList.remove('star-light');
                currentStar.classList.add('text-warning');
            }
        });
        star.addEventListener('click', function () {
            rating_data = parseInt(this.getAttribute('data-rating'));
        });
    });

    // Save review using vanilla JS fetch API
    document.getElementById('save_review').addEventListener('click', function () {
        var user_name = document.getElementById('user_name').value.trim();
        var user_review = document.getElementById('user_review').value.trim();
        // Extract technician ID from the current URL
        const url = window.location.href;
        const tech_id = url.split('/').pop();

        if (user_name === '' || user_review === '') {
            alert("Please Fill Both Field");
            return;
        } else {
            var formData = new FormData();
            formData.append('tech_id', tech_id);
            formData.append('user_name', user_name);
            formData.append('user_rating', rating_data);
            formData.append('user_review', user_review);

            fetch("submit-rating", {
                method: "POST",
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    hideModal();
                    load_rating_data();
                    alert(data);
                })
                .catch(error => console.error('Error:', error));
        }
    });

    // Load rating data via fetch
    function load_rating_data() {
        // Extract technician ID from URL
        const url = window.location.href;
        const tech_id = url.split('/').pop();

        var formData = new FormData();
        formData.append('action', 'load_data');
        formData.append('tech_id', tech_id);

        fetch("fetch-reviews", {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                document.getElementById('average_rating').textContent = data.average_rating;
                document.getElementById('total_review').textContent = data.total_review;

                // Update main stars based on the average rating
                var mainStars = document.querySelectorAll('.main_star');
                var count_star = 0;
                mainStars.forEach(function (star) {
                    count_star++;
                    if (Math.ceil(data.average_rating) >= count_star) {
                        star.classList.add('text-warning');
                        star.classList.remove('star-light');
                    } else {
                        star.classList.remove('text-warning');
                        star.classList.add('star-light');
                    }
                });

                // Update individual review counts
                document.getElementById('total_five_star_review').textContent = data.five_star_review;
                document.getElementById('total_four_star_review').textContent = data.four_star_review;
                document.getElementById('total_three_star_review').textContent = data.three_star_review;
                document.getElementById('total_two_star_review').textContent = data.two_star_review;
                document.getElementById('total_one_star_review').textContent = data.one_star_review;

                // Update progress bars
                if (data.total_review > 0) {
                    document.getElementById('five_star_progress').style.width = (data.five_star_review / data.total_review * 100) + '%';
                    document.getElementById('four_star_progress').style.width = (data.four_star_review / data.total_review * 100) + '%';
                    document.getElementById('three_star_progress').style.width = (data.three_star_review / data.total_review * 100) + '%';
                    document.getElementById('two_star_progress').style.width = (data.two_star_review / data.total_review * 100) + '%';
                    document.getElementById('one_star_progress').style.width = (data.one_star_review / data.total_review * 100) + '%';
                } else {
                    document.getElementById('five_star_progress').style.width = '0%';
                    document.getElementById('four_star_progress').style.width = '0%';
                    document.getElementById('three_star_progress').style.width = '0%';
                    document.getElementById('two_star_progress').style.width = '0%';
                    document.getElementById('one_star_progress').style.width = '0%';
                }

                // Display reviews
                if (data.review_data && data.review_data.length > 0) {
                    var html = '';
                    data.review_data.forEach(function (review) {
                        html += '<div class="row mb-3">';
                        html += '<div class="col-sm-1"><div style="background:#010336; color:#fff; padding:25px; text-align:center; border-radius:50%; margin-left: 20px"><h2 style="margin:0;">' + review.user_name.split(' ').map(n => n[0]).join('') + '</h2></div></div>';
                        html += '<div class="col-sm-11">';
                        html += '<div class="card">';
                        html += '<div class="card-header"><b>' + review.user_name + '</b></div>';
                        html += '<div class="card-body">';
                        for (var star = 1; star <= 5; star++) {
                            var class_name = review.rating >= star ? 'text-warning' : 'star-light';
                            html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                        }
                        html += '<br /><p class="review-text">' + review.user_review + '</p>';
                        html += '</div>';
                        html += '<div class="card-footer">On ' + review.datetime + '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                    });
                    document.getElementById('review_content').innerHTML = html;
                } else {
                    document.getElementById('review_content').innerHTML = '';
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Load rating data when the page loads
    load_rating_data();
});