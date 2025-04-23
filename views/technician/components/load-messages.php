<?php

use app\core\Application;

?>

<header>
    <a href="/technician-messages" class="back-icon"><i class="fas fa-arrow-left"></i></a>
    <img src="<?php echo $customer['profile_picture'] ?? '/assets/user_avatar.png'; ?>" alt="">
    <div class="details">
        <span><?php echo $customer['fname'] . ' ' . $customer['lname']; ?></span>
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