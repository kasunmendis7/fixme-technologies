<?php
/** @var $technician app\models\Technician */

use app\core\Application;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $technician['fname'] . ' ' . $technician['lname'] ?> - Profile</title>
    <title>Profile</title>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/customer/flash-messages.css">
    <link rel="stylesheet" href="/css/customer/technician-profile.css">
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
            <img src="<?php echo $technician['profile_picture'] ?>" alt="Technician Profile Picture">
        </div>
        <div class="profile-details">
            <h2><?php echo $technician['fname'] . ' ' . $technician['lname'] ?></h2>
            <p>Technician</p>
        </div>
        <div class="status">
            <div class="availability">
                <span class="status-dot"></span>
                <span>Available</span>
            </div>
            <button class="message-btn"
                    onclick="viewUser( <?php echo $technician['tech_id'] ?> )">
                Message
            </button>
            <button class="message-btn"
                    onclick="sendRequest( <?php echo $technician['tech_id'] . ', ' . Application::$app->session->get('customer') ?> )"
            >
                Request
            </button>
        </div>
    </div>
</header>

<?php if (Application::$app->session->getFlash('createCusTechReq-success')): ?>
    <div class="alert alert-success">
        <?php echo Application::$app->session->getFlash('createCusTechReq-success') ?>
    </div>
<?php endif; ?>
<?php if (Application::$app->session->getFlash('createCusTechReq-error')): ?>
    <div class="alert alert-error">
        <?php echo Application::$app->session->getFlash('createCusTechReq-error') ?>
    </div>
<?php endif; ?>

<nav class="tabs">
    <button class="tab active">Feed</button>
    <button class="tab" onclick="scrollToSection('ratings-reviews-section');">Ratings & Reviews</button>
</nav>

<main class="content">
    <div class="cards">
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <article class="card">
                    <div class="card-image">
                        <img src="/assets/uploads/<?php echo $post['media']; ?>" alt="Post Media">
                    </div>
                    <div class="card-content">
                        <h3><?php echo $technician['fname'] . ' ' . $technician['lname']; ?></h3>
                        <p><?php echo htmlspecialchars($post['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p><small>Posted on <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?></small>
                        </p>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No posts to display.</p>
        <?php endif; ?>
    </div>
</main>

<?php
include_once 'components/technician-reviews.php';
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
<script src="/js/customer/technician-profile.js"></script>
<script src="/js/customer/customer-home.js"></script>
<script src="/js/customer/overlay.js"></script>
</body>

</html>


