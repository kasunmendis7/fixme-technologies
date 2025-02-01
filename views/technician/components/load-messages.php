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
    <title>Document</title>
</head>
<body>
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
</body>
</html>