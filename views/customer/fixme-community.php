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
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
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
        <?php endif; ?>
    </div>
</section>

<?php foreach ($posts

as $post): ?>
<section class="post-section">
    <div class="post">
        <div class="post-header">
            <div class="profile-info">
                <div class="profile-img">
                    <img src="<?php echo htmlspecialchars($post['profile_picture']) ?>" alt="Profile Pic">
                </div>
                <!--                    //echo htmlspecialchars($post['fname'] . ' ' . $post['lname']); ?-->
                <span class="username"><?php echo htmlspecialchars($post['fname']); ?></span>
            </div>

            <?php if (isset(Application::$app->technician) && Application::$app->technician->tech_id == $post['tech_id']): ?>
                <div class="options">
                    <a href="/technician-edit-post?post_id=<?php echo $post['post_id']; ?>">
                        <button class="post-edit-btn">Edit</button>
                    </a>
                    <form action="/technician-delete-post" method="POST">
                        <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                        <button type="submit" class="post-delete-btn">Delete</button>
                    </form>

                </div>
            <?php endif; ?>

        </div>

        <div class="post-img">
            <img src="/assets/uploads/<?php echo htmlspecialchars($post['media']); ?>" alt="">
        </div>
        <div class="post-body">
            <div class="post-actions">
                <button id="likeIcons" class="like-button" data-post-id="<?php echo $post['post_id']; ?>"
                        data-liked="<?php echo $post['user_liked'] ? 'true' : 'false'; ?>">
                    <ion-icon name="<?php echo $post['user_liked'] ? 'build' : 'build-outline'; ?>"></ion-icon>
                </button>

                <span class="comment-icon">
                    <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
                </span>
            </div>
            <div class="post-info">
                <span id="likeCounts" class="like-count" data-post-id="<?php echo $post['post_id']; ?>">
                    <?php echo $post['like_count'] ? $post['like_count'] . ' ' . ($post['like_count'] == 1 ? 'like' : 'likes') : '0 likes'; ?>
                </span>
                <div class="post-title">
                    <span class="username"><?php echo htmlspecialchars($post['fname']); ?></span>
                    <span class="description"><?php echo htmlspecialchars($post['description']); ?></span>
                    <br>
                </div>
            </div>
            <?php if (!empty($post['comments'])): ?>
                <div class="post-comments">
                    <span>View all <?php echo count($post['comments']); ?> comments</span>
                    <?php foreach ($post['comments'] as $comment): ?>
                        <div class="comment">
                            <span class="comment-username"><?php echo htmlspecialchars($comment['fname']); ?></span>

                            <!-- Check if the comment is being edited -->
                            <?php if (isset($_GET['edit_comment_id']) && $_GET['edit_comment_id'] == $comment['comment_id']): ?>
                                <!-- Edit Comment Form -->
                                <form action="/comment-edit" method="POST">
                                    <input type="hidden" name="comment_id"
                                           value="<?php echo $comment['comment_id']; ?>">
                                    <input type="text" name="comment_text"
                                           value="<?php echo htmlspecialchars($comment['comment_text']); ?>" required>
                                    <button type="submit">Save</button>
                                    <a href="/technician-community">Cancel</a>
                                </form>
                            <?php else: ?>
                                <!-- Display Comment -->
                                <span class="comment-text"><?php echo htmlspecialchars($comment['comment_text']); ?></span>
                                <?php if ($comment['cus_id'] == Application::$app->customer->cus_id): ?>
                                    <div class="comment-options">
                                        <a href="/technician-community?edit_comment_id=<?php echo $comment['comment_id']; ?>"
                                           class="comment-edit-btn">Edit</a>
                                        <form action="/comment-delete" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                            <input type="hidden" name="comment_id"
                                                   value="<?php echo $comment['comment_id']; ?>">
                                            <button type="submit" class="comment-delete-btn">Delete</button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>


            <div class="post-timestamp">
                <span><?php echo htmlspecialchars($post['created_at']); ?></span>
            </div>
        </div>
        <div class="input-box">
            <form action="/comment-create" method="POST">
                <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                <input type="text" name="comment_text" placeholder="Add a comment..." class="text" required>
                <button type="submit">Post</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</section>

<!-- Overlay for the confirmation message -->
<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/technician-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>

<script src="/js/technician/technician-community.js"></script>
<script src="/js/customer/overlay.js"></script>
<!-- Icons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
