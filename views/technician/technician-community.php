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
    <main class="post">
        <div class="wrapper">
            <section class="create-post">
                <header class="header">
                    <h1>Create post</h1>
                    <div class="cross-icon">
                        <div class="cross-icon-mark"></div>
                    </div>
                </header>
                <div class="post-header">
                    <div class="profile-pic"></div>
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
                    <form action="" method="">

						<textarea name="description" id="description"
                                  cols="30" rows="5"
                                  placeholder="What's on you mind?"></textarea>
                        <div class="emoji-picker">
                            <emoji-picker class="light"></emoji-picker>
                            <i class="emoji" aria-label="Insert an emoji"
                               role="img"></i>
                        </div>
                        <div class="add-to-your-post">
                            <span class="add-to-post-text">Add to your post</span>
                            <div class="add-to-post-icons">
                                <div class="photo-video"></div>
                                <div class="tag-people"></div>
                                <div class="feeling-activity"></div>
                                <div class="check-in"></div>
                                <div class="gif"></div>
                                <div class="live-video"></div>
                            </div>
                        </div>
                        <!-- Post Button -->
                        <button type="submit" value="Post" class="post-btn" disabled>Post</button>
                    </form>
                </div>
            </section>

        </div>
    </main>
    <!-- JavaScript Files -->
    <script src="/js/technician/technician-create-post.js"></script>

    <!--    Icons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>