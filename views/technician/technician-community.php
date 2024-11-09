<?php
use app\core\Application;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Dashboard</title>
    <link rel="stylesheet" href="/css/technician/technician-community.css">
</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<section>
    <div class="flash-message">
        <?php if (Application::$app->session->getFlash('success')): ?>
            <div class="alert alert-success">
                <?php echo Application::$app->session->getFlash('success') ?>
            </div>
        <?php endif;?>
    </div>
</section>

<?php foreach ($posts as $post): ?>
<section class="post-section">
        <div class="post">
            <div class="post-header">
                <div class="profile-info">
                    <div class="profile-img">
                        <img src="/assets/technician-dashboard/customer02.jpg" alt="">
                    </div>
<!--                    //echo htmlspecialchars($post['fname'] . ' ' . $post['lname']); ?-->
                    <span class="username"><?php echo htmlspecialchars($post['fname'] ); ?></span>
                </div>


                <?php if (Application::$app->technician->tech_id == $post['tech_id']): ?>
                <div class="options">
                    <a href="/technician-edit-post?post_id=<?php echo $post['post_id']; ?>">
                        <button class="post-edit-btn">Edit</button>
                    </a>
                    // Add the delete button here along with the class="post-delete-btn"

                </div>
                <?php endif; ?>

            </div>

            <div class="post-img">
                <img src="/assets/uploads/<?php echo htmlspecialchars($post['media']); ?>" alt="">
            </div>
            <div class="post-body">
                <div class="post-actions">
                    <span class="like-icon"><ion-icon name="build-outline"></ion-icon></span>
                    <span class="comment-icon"><ion-icon name="chatbubble-ellipses-outline"></ion-icon></span>
                </div>
                <div class="post-info">
                    <div class="post-likes">500 likes</div>
                    <div class="post-title">
<!--                        //echo htmlspecialchars($post['fname'] . ' ' . $post['lname']); ?-->
                        <span class="username"><?php echo htmlspecialchars($post['fname']); ?></span>
                        <span class="description"><?php echo htmlspecialchars($post['description']); ?></span>
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
                    <span><?php echo htmlspecialchars($post['created_at']); ?></span>
                </div>
            </div>
            <div class="input-box">
                <div class="emoji"></div>
                <input type="text" placeholder="Add a comment..." class="text">
                <button>Post</button>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<!-- Icons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
