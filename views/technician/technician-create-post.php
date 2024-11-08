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
<section class="create-post">
    <div class="wrapper">
        <header class="header">
            <h1>Create post</h1>
            <div class="cross-icon">
                <div class="cross-icon-mark"></div>
            </div>
        </header>
        <div class="create-post-header">
            <div class="profile-pic"><img src="/assets/technician-dashboard/customer02.jpg" alt=""></div>
            <div class="user-info">
                <div class="full-name">Fix Me</div>
                <div class="post-audience">
                    <div class="friends-icon"></div>
                    <span class="audience-text">Community</span>
                    <div class="drop-down"></div>
                </div>
            </div>
        </div>
        <div class="post-content">
            <form action="" method="POST" enctype="multipart/form-data">
                <textarea name="description" id="description" cols="50" rows="3"
                          placeholder="What's on you mind?"></textarea>
                <div class="add-to-your-post">
                    <span class="add-to-post-text">Add to your post</span>
                    <div class="add-to-post-icons">
                        <div class="photo-video"></div>
                        <input type="file" name="media" accept="image/*,video/*">
                    </div>
                </div>
                <!-- Post Button -->
                <button type="submit" value="Post" class="post-btn" disabled>Post</button>
            </form>
        </div>
    </div>
</section>
</body>
</html>