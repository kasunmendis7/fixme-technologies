<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
    <link rel="stylesheet" href="/css/technician/technician-community.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">

</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<section class="create-post">
    <div class="wrapper">
        <header class="header">
            <h1>Edit the post</h1>
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
            <form action="/technician-edit-post" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post->post_id); ?>">

                <textarea name="description" id="description" cols="50" rows="3"
                          placeholder="What's on your mind?"><?php echo htmlspecialchars($post->description); ?></textarea>

                <div class="add-to-your-post">
                    <span class="add-to-post-text">Add to your post</span>
                    <div class="add-to-post-icons">
                        <div class="photo-video"></div>
                        <input type="file" name="media" accept="image/*,video/*">
                    </div>
                </div>
                <button type="submit" class="post-btn">Update</button>
            </form>
        </div>
    </div>
</section>

<!-- Overlay for the confirmation message -->
<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/technician-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>

<script src="/js/technician/overlay.js"></script>

</body>
</html>
