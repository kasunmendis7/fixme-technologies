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

                <div class="settings-icon">
                    <ion-icon name="settings-outline"></ion-icon>
                </div>
                <?php if (Application::$app->technician->tech_id == $post['tech_id']): ?>
                <div class="options">
                    <a href="/technician-edit-post?post_id=<?php echo $post['post_id']; ?>">
                        <button class="post-edit-btn">Edit</button>
                    </a>
                    <form action="/technician-delete-post" method="POST" >
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
                <?php if (!empty($post['comments'])): ?>
                    <div class="post-comments">
                        <span>View all <?php echo count($post['comments']); ?> comments</span>
                        <?php foreach ($post['comments'] as $comment): ?>
                            <div class="comment">
                                <span class="comment-username"><?php echo htmlspecialchars($comment['fname']); ?></span>
                                <span class="comment-text"><?php echo htmlspecialchars($comment['comment_text']); ?></span>

                                <!-- Display Edit and Delete buttons if the logged-in user is the comment owner -->
                                <?php if ($comment['cus_id'] == Application::$app->customer->cus_id): ?>
                                    <div class="comment-options">
                                        <a href="/comment-edit?comment_id=<?php echo $comment['comment_id']; ?>" class="comment-edit-btn">Edit</a>
                                        <form action="/comment-delete" method="POST" style="display:inline;">
                                            <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
                                            <button type="submit" class="comment-delete-btn">Delete</button>
                                        </form>
                                    </div>
                                <?php endif; ?>

                                <span class="like-icon"><ion-icon name="build-outline"></ion-icon></span>
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

<!-- Icons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
