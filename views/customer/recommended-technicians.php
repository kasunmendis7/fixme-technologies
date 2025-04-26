<?php

use app\core\Application;
use app\models\CusTechReq;

/** @var $technicians */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recommended Technicians</title>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/customer/flash-messages.css">
    <link rel="stylesheet" href="/css/customer/recommended-technicians.css">
</head>

<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<div class="container">
    <div class="title-main">
        <h1>System Recommended Technicians</h1>
    </div>

    <div class="techs-wrapper">
        <?php
        // Check if technicians array has at least one item
        if (!empty($technicians)) {
            // Display only top 2 technicians
            $recommendedTechs = array_slice($technicians, 0, 2);

            foreach ($recommendedTechs as $tech): ?>
                <div class="tech-card">
                    <!-- Technician's profile picture -->
                    <img src="<?= htmlspecialchars($tech['profile_picture']) ?>"
                         alt="Profile Picture of <?= htmlspecialchars($tech['fname'] . ' ' . $tech['lname']) ?>"
                         class="profile-picture">

                    <!-- Technician information -->
                    <div class="tech-info">
                        <h2><?= htmlspecialchars($tech['fname'] . ' ' . $tech['lname']) ?></h2>
                        <div class="rating">
                            <?php for ($i = 0; $i < floor($tech['rating']); $i++): ?>
                                <ion-icon name="star"></ion-icon>
                            <?php endfor; ?>
                            <?php if ($tech['rating'] - floor($tech['rating']) >= 0.5): ?>
                                <ion-icon name="star-half"></ion-icon>
                            <?php endif; ?>
                            <span><?= htmlspecialchars(number_format($tech['rating'], 1)) ?>/5.0</span>
                        </div>
                        <a href="/technician-profile/<?= urlencode($tech['tech_id']) ?>" class="view-profile-btn">View
                            Profile</a>
                    </div>
                </div>
            <?php endforeach;
        } else { ?>
            <div class="no-techs-message">
                No technicians are currently recommended. Please check back later!
            </div>
        <?php } ?>
    </div>
</div>
<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/customer/overlay.js"></script>
<script src="/js/customer/recommended-technicians"></script>
</body>

</html>
