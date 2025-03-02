<?php

use app\core\Application;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technician Home</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="/css/technician/technician-messages.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">

</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<div class="container">
    <!-- ========= left side ========== -->
    <div class="left-side">
        <div class="wrapper">
            <section class="users">
                <header>
                    <div class="content">
                        <img src="<?php echo Application::$app->technician->profile_picture ?>" alt="Profile Pic">

                        <div class="details">
                            <span><?php echo Application::$app->technician->fname . ' ' . Application::$app->technician->lname ?></span>
                        </div>
                    </div>
                </header>
                <!--Search button-->
                <div class="search">
                    <input type="text" placeholder="Enter name to search...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list">
                    <?php include_once 'components/load-user-list.php'; ?>
                </div>
            </section>
        </div>
    </div>

    <!-- ========= right side ========== -->
    <div class="right-side">
        <div class="wrapper">
            <section class="chat-area">

                <?php include_once 'components/load-messages.php'; ?>
            </section>
            <div class="message-area">
                <form action="#" class="typing-area"
                      autocomplete="off">
                    <input type="text" name="message" class="input-field" placeholder="Type a message here...">
                    <button type="submit"
                            onclick="sendMessage( <?php echo Application::$app->session->get('technician') ?> )">
                        <i class="fab fa-telegram-plane"></i></button>
                </form>
            </div>
        </div>
    </div>


    <!-- icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- JavaScript Files -->
    <script src="/js/technician/customer-messages.js"></script>
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