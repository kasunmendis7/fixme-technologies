<?php

use app\core\Application;

?>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">Ratings & Reviews
            of <?php echo $technician['fname'] . ' ' . $technician['lname'] ?></div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 text-center">
                    <h1 class="text-warning mt-4 mb-4">
                        <b><span id="average_rating">0.0</span> / 5</b>
                    </h1>
                    <!-- show 5 stars -->
                    <div class="mb-3">
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                    </div>
                    <!-- view the total number of reviews -->
                    <h3>Total Number of Reviews: <span id="total_review">0</span></h3>
                </div>
                <div class="col-sm-4">
                    <div>
                        <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>
                        <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar" id="five_star_progress"></div>
                        </div>
                    </div>
                    <div>
                        <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                        <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar" id="four_star_progress"></div>
                        </div>
                    </div>
                    <div>
                        <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                        <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar" id="three_star_progress"></div>
                        </div>
                    </div>
                    <div>
                        <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                        <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar" id="two_star_progress"></div>
                        </div>
                    </div>
                    <div>
                        <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                        <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                        <div class="progress">
                            <div class="progress-bar" id="one_star_progress"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 text-center">
                    <h3 class="write_review_here">Write Review Here</h3>
                    <button type="button" id="add_review" class="btn btn-primary">Review</button>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5" id="review_content"></div>
</div>

<!-- Modal -->
<div id="review_modal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Review</h5>
                <button type="button" class="close" id="modal_close">&times;</button>
            </div>
            <div class="modal-body">
                <h3 class="text-center mt-2 mb-4">
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                </h3>
                <input type="hidden" id="user_name"
                       value="<?php echo Application::$app->customer->fname . ' ' . Application::$app->customer->lname; ?>"/>
                <textarea id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                <div class="text-center mt-4">
                    <button type="button" id="save_review" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/customer/technician-reviews.js"></script>
</body>