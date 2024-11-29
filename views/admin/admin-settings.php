<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Settings</title>
    <link rel="stylesheet" href="/css/admin/admin-settings.css">
    <link rel="stylesheet" href="/css/admin/overlay.css">
</head>

<body>
<?php

use app\core\Application;

include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<div class="cardBox">
    <a href="/admin-profile">
        <div class="card">
            <div>
                <div class="cardName">My Profile</div>
            </div>
            <div class="iconBx">
                <ion-icon name="person-circle-outline"></ion-icon>
            </div>
        </div>
    </a>
</div>

<!-- Overlay for the confirmation message -->
<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/admin-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>
<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/admin/admin-home.js"></script>
<script src="/js/admin/overlay.js"></script>
</body>

</html>