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
<?php foreach ($customers as $customer): ?>
    <a href="customer-messages/<?= $customer['cus_id']; ?>"
       onclick="event.preventDefault(); viewChat(<?= $customer['cus_id']; ?>)">
        <div class="content">
            <img src="<?php echo $customer['profile_picture'] ?? '/assets/user_avatar.png'; ?>"
                 alt="">
            <div class="details">
                <span><?php echo htmlspecialchars($customer['fname'] . ' ' . $customer['lname']); ?></span>
                <p>This is the latest message</p>
            </div>
        </div>
        <div class="status-dot"><i class="fas fa-circle"></i></div>
    </a>
<?php endforeach; ?>
</body>
</html>