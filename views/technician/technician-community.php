<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technician Dashboard</title>
    <link rel="stylesheet" href="/css/technician/technician-community.css">
</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<!-- JavaScript Files -->
<script src="/js/technician/technician-create-post.js"></script>
<section class="post-section">
<!--    --><?php //if (Application::$app->session->getFlash('success')): ?>
<!--        <div class="alert alert-success">-->
<!--            --><?php //echo Application::$app->session->getFlash('success') ?>
<!--        </div>-->
<!--    --><?php //endif;?>
    <div class="post">
        <div class="post-header">
            <div class="profile-info">
                <div class="profile-img">
                    <img src="/assets/technician-dashboard/customer02.jpg" alt="">
                </div>
                <span>Kasun Mendis</span>
            </div>
            <div class="options">
                <span><ion-icon name="settings-outline"></ion-icon></span>
            </div>
        </div>

        <div class="post-img">
            <img src="https://thumbs.dreamstime.com/b/car-fixing-driver-trying-to-repair-battery-road-39783905.jpg"
                 alt="">
        </div>
        <div class="post-body">
            <div class="post-actions">
                <span class="like-icon"><ion-icon name="build-outline"></ion-icon></span>
                <span class="comment-icon"><ion-icon name="chatbubble-ellipses-outline"></ion-icon></span>

            </div>
            <div class="post-info">
                <div class="post-likes">500 likes</div>
                <div class="post-title">
                    <span class="username">Kasun Mendis</span>
                    <span class="title">Today at Colombo 7</span>
                    <br>
                </div>
            </div>
            <div class="post-comments">
                <span>View all 20 comments</span>
                <div class="comment">
                    <span class="comment-username">Pulasthi</span>
                    <span class="comment-text">He helped me a lot</span>
                    <span class="like-icon"><ion-icon name="build-outline"></ion-icon></span>
                </div>
            </div>
            <div class="post-timestamp">
                <span >1 hour ago</span>
            </div>
        </div>
        <div class="input-box">
            <div class="emoji"></div>
            <input type="text" placeholder="Add a comment..." class="text">
            <button>Post</button>
        </div>
    </div>

</section>


<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>