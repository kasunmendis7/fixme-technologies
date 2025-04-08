<?php
/** @var $serviceCenter app\models\ServiceCenter */

use app\core\Application;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Center</title>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/customer/flash-messages.css">
    <link rel="stylesheet" href="/css/customer/service-center-profile.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" crossorigin="anonymous"/>
    <!-- adding the css styling -->
    <link rel="stylesheet" href="/css/customer/reviews.css">
</head>

<body>
<?php

include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<!--https://via.placeholder.com/100-->
<header class="header">
    <!--    <div class="banner"></div>-->
    <div class="profile-info">
        <div class="profile-pic">
            <!--            <img src="-->
            <?php //echo $technician['profile_picture'] ?><!--" alt="Technician Profile Picture">-->
        </div>
        <div class="profile-details">
            <h2><?php echo $serviceCenter['name'] ?></h2>
            <p>Service center</p>
        </div>
        <div class="status">
            <div class="availability">
                <span class="status-dot"></span>
                <span>Available</span>
            </div>
            <button class="message-btn">Message</button>
            <button class="message-btn">Call</button>
            <button class="message-btn"
                    onclick="sendRequest( <?php echo $serviceCenter['ser_cen_id'] . ', ' . Application::$app->session->get('customer') ?> )"
            >
                Request
            </button>
        </div>
    </div>
</header>

<?php if (Application::$app->session->getFlash('createCusSerCenReq-success')): ?>
    <div class="alert alert-success">
        <?php echo Application::$app->session->getFlash('createCusSerCenReq-success') ?>
    </div>
<?php endif; ?>
<?php if (Application::$app->session->getFlash('createCusSerCenReq-error')): ?>
    <div class="alert alert-error">
        <?php echo Application::$app->session->getFlash('createCusSerCenReq-error') ?>
    </div>
<?php endif; ?>

<nav class="tabs">
    <button class="tab active">Feed</button>
    <button class="tab">Ratings & Reviews</button>
</nav>

<main class="content">
    <div class="cards">
        <!-- Profile Card 1 -->
        <article class="card">
            <div class="card-image">
                <!--                <img src="/assets/uploads/tech1.jpg" alt="Technician Profile Picture">-->
            </div>
            <div class="card-content">
                <h3>Shane Mario</h3>
                <p>Expert in electrical repairs with 10+ years of experience.</p>
                <p><small>Posted on <?php echo date('F j, Y, g:i a'); ?></small></p>
                <button class="message-btn">Message</button>
            </div>
        </article>

        <!-- Profile Card 2 -->
        <article class="card">
            <div class="card-image">
                <!--                <img src="/assets/uploads/tech2.jpg" alt="Technician Profile Picture">-->
            </div>
            <div class="card-content">
                <h3>Alex Johnson</h3>
                <p>Specialist in plumbing and maintenance with a reputation for quick solutions.</p>
                <p><small>Posted on <?php echo date('F j, Y, g:i a'); ?></small></p>
                <button class="message-btn">Message</button>
            </div>
        </article>

        <!-- Profile Card 3 -->
        <article class="card">
            <div class="card-image">
                <!--                <img src="/assets/uploads/tech3.jpg" alt="Technician Profile Picture">-->
            </div>
            <div class="card-content">
                <h3>Lisa Ray</h3>
                <p>Certified HVAC technician, ensuring quality and efficient services.</p>
                <p><small>Posted on <?php echo date('F j, Y, g:i a'); ?></small></p>
                <button class="message-btn">Message</button>
            </div>
        </article>
    </div>
</main>

<!-- Feedback Section -->
<?php
include_once 'components/service-center-reviews.php';
?>


<!--<main class="content">-->
<!--    <div class="cards">-->
<!--        <!-- Card Template -->
<!--        <article class="card">-->
<!--            <div class="card-image">-->
<!--                <img src="https://via.placeholder.com/150" alt="Food Image">-->
<!--            </div>-->
<!--            <div class="card-content">-->
<!--                <h3>Shane Mario</h3>-->
<!--                <p>You and your family will love this refreshing salad that's perfect for warm days or summer meals!</p>-->
<!--                <button class="visit-btn">Visit Us</button>-->
<!--            </div>-->
<!--        </article>-->
<!--        <!-- Repeat as needed -->
<!--        <article class="card">-->
<!--            <div class="card-image">-->
<!--                <img src="https://via.placeholder.com/150" alt="Food Image">-->
<!--            </div>-->
<!--            <div class="card-content">-->
<!--                <h3>Shane Mario</h3>-->
<!--                <p>You and your family will love this refreshing salad that's perfect for warm days or summer meals!</p>-->
<!--                <button class="visit-btn">Visit Us</button>-->
<!--            </div>-->
<!--        </article>-->
<!--    </div>-->
<!--</main>-->

<!-- Overlay for the confirmation message -->
<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/customer-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>
<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/customer/service-center-profile.js"></script>
<script src="/js/customer/customer-home.js"></script>
<script src="/js/customer/overlay.js"></script>
</body>

</html>


