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
    <title>loading user list</title>
</head>
<body>
<?php foreach ($customers as $customer): ?>
    <button type="button"
            onclick="viewUser(<?= htmlspecialchars(json_encode($customer['cus_id'])); ?>)">
        <div class="content">
            <img src="<?php echo htmlspecialchars($customer['profile_picture'] ?? '/assets/user_avatar.png'); ?>"
                 alt="<?php echo htmlspecialchars($customer['fname'] . ' ' . $customer['lname']); ?>'s profile picture">
            <div class="details">
                <span><?php echo htmlspecialchars($customer['fname'] . ' ' . $customer['lname']); ?></span>
                <p><?php echo htmlspecialchars($customer['last_message'] ?? 'No messages yet.'); ?></p>
            </div>
        </div>
    </button>
<?php endforeach; ?>
</body>
</html>