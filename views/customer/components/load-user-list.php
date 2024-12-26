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
<?php foreach ($technicians as $technician): ?>
    <button type="button"
            onclick="viewUser(<?= htmlspecialchars(json_encode($technician['tech_id'])); ?>)">
        <div class="content">
            <img src="<?php echo htmlspecialchars($technician['profile_picture'] ?? '/assets/user_avatar.png'); ?>"
                 alt="<?php echo htmlspecialchars($technician['fname'] . ' ' . $technician['lname']); ?>'s profile picture">
            <div class="details">
                <span><?php echo htmlspecialchars($technician['fname'] . ' ' . $technician['lname']); ?></span>
                <p><?php echo htmlspecialchars($technician['last_message'] ?? 'No messages yet.'); ?></p>
            </div>
        </div>
        <div class="status-dot" aria-label="Status">
            <i class="fas fa-circle"></i>
        </div>
    </button>
    <!--    </a>-->
<?php endforeach; ?>
</body>
</html>