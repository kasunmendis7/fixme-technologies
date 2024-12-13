<?php

use app\core\Application;

?><!doctype html>
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
                        <img src="<?= Application::$app->technician->profile_picture ? '/assets/uploads/' . Application::$app->technician->profile_picture : '/assets/user_avatar.png'; ?>"
                             alt="">
                        <div class="details">
                            <span><?php echo Application::$app->technician->fname . ' ' . Application::$app->technician->lname ?></span>
                            <!--                             <p>Active Now</p> to add active we need a status but i don't have that -->
                        </div>
                    </div>
                </header>
                <!--Search button-->
                <div class="search">
                    <input type="text" placeholder="Enter name to search...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list">
                    <?php foreach ($customers as $customer): ?>
                        <a href="customer-messages/<?= $customer['cus_id']; ?>"
                           onclick="event.preventDefault(); viewChat(<?= $customer['cus_id']; ?>)">
                            <div class="content">
                                <img src="<?php echo $customer['profile_picture'] ?? '/assets/user_avatar.png'; ?>"
                                     alt="">
                                <div class="details">
                                    <span><?php echo htmlspecialchars($customer['fname'] . ' ' . $customer['lname']); ?></span>
                                    <p>This is a test message</p>
                                </div>
                            </div>
                            <div class="status-dot"><i class="fas fa-circle"></i></div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </div>

    <!-- ========= right side ========== -->
    <div class="right-side">
        <div class="wrapper">
            <section class="chat-area">
                <header>
                    <a href="/technician-messages" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    <img src="<?php echo $customer['profile_picture'] ?? '/assets/user_avatar.png'; ?>" alt="">
                    <div class="details">
                        <span><?php echo htmlspecialchars($customer['fname'] . ' ' . $customer['lname']); ?>    </span>
                        <p>Active Now</p>
                    </div>
                </header>
                <div class="chat-box">
                    <?php foreach ($messages as $message): ?>
                        <?php if ($message['outgoing_msg_id'] === Application::$app->session->get('technician')): ?>
                            <div class="chat outgoing">
                                <div class="details">
                                    <p><?php echo htmlspecialchars($message['message']); ?></p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="chat incoming">
                                <img src="<?php echo $customer['profile_picture'] ?? '/assets/user_avatar.png'; ?>"
                                     alt="">
                                <div class="details">
                                    <p><?php echo htmlspecialchars($message['message']); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <form action="#" class="typing-area" autocomplete="off">
                    <input type="text" name="outgoing_id" value="<?php echo Application::$app->technician->tech_id; ?>"
                           hidden>
                    <input type="text" name="incoming_id" value="<?php echo $customer['cus_id']; ?>" hidden>
                    <input type="text" name="message" class="input-field" placeholder="Type a message here...">
                    <button><i class="fab fa-telegram-plane"></i></button>
                </form>
            </section>
        </div>
    </div>


    <!-- icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- JavaScript Files -->
    <script src="/js/technician/technician-messages.js"></script>
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