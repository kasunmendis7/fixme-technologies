<?php
use app\core\Application;
?>
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
        <?php if (Application::$app->session->getFlash('success')): ?>
            <div class="alert alert-success">
                <?php echo Application::$app->session->getFlash('success') ?>
            </div>
        <?php endif;?>
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
            <form action="/technician-community" method="POST" enctype="multipart/form-data">
                <textarea name="description" id="description" cols="50" rows="3" placeholder="What's on your mind?"></textarea>
                <div class="add-to-your-post">
                    <span class="add-to-post-text">Add to your post</span>
                    <div class="add-to-post-icons">
                        <div class="photo-video"></div>
                        <input type="file" name="media" accept="image/*,video/*">
                    </div>
                </div>
                <button type="submit" value="Post" class="post-btn" disabled>Post</button>
            </form>
        </div>
    </div>
</section>
<section class="post-section">
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <div class="post-header">
                <div class="profile-info">
                    <div class="profile-img">
                        <img src="/assets/technician-dashboard/customer02.jpg" alt="">
                    </div>
                    <span><?php echo htmlspecialchars($post['tech_id']); ?></span>
                </div>
            </div>

            <?php if ($post['media_url']): ?>
                <div class="post-img">
                    <img src="<?php echo htmlspecialchars($post['media_url']); ?>" alt="">
                </div>
            <?php endif; ?>

            <div class="post-body">
                <div class="post-title">
                    <span><?php echo htmlspecialchars($post['description']); ?></span>
                </div>
                <div class="post-timestamp">
                    <span><?php echo htmlspecialchars($post['created_at']); ?></span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>


<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>