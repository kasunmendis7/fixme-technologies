<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Settings</title>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/technician/technician-settings.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">
</head>

<body>
<?php

use app\core\Application;

include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<div class="cardBox">
    <a href="/technician-profile">
        <div class="card">
            <div>
                <div class="cardName">My Profile</div>
            </div>
            <div class="iconBx">
                <ion-icon name="person-circle-outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="#">
        <div class="card">
            <div>
                <div class="cardName">Payment Details</div>
            </div>
            <div class="iconBx">
                <ion-icon name="card-outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="/technician-transactions">
        <div class="card">
            <div>
                <div class="cardName">Transactions</div>
            </div>
            <div class="iconBx">
                <ion-icon name="receipt-outline"></ion-icon>
            </div>
        </div>
    </a>
</div>

<!-- Overlay for the confirmation message -->
<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/technician-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>
<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/customer/customer-home.js"></script>
<script src="/js/technician/overlay.js"></script>
</body>

</html>