<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technician Dashboard</title>
    <link rel="stylesheet" href="/css/technician/technician-dashboard.css">
    <link rel="stylesheet" href="/css/technician/technician-payment-details.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">

</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<!-- JavaScript Files -->
<script src="/js/technician/technician-home.js"></script>

<section class="section-2">
    <div class="select-bank-account">Select Bank Account</div>
    <div class="payment-container">
        <div class="payment-card-1">
            <div class="img-box">
                <img src="https://seeklogo.com/images/N/nations-trust-bank-logo-B7AF1BD370-seeklogo.com.png"
                     alt="Nations Trust">
            </div>
            <div class="number">
                <span>**** **** **** 1060</span>
            </div>
            <div class="details">
                <span>Name: Kasun Mendis</span>
                <span>Branch: Panadura</span>
            </div>
        </div>
        <div class="payment-card-2">
            <div class="img-box">
                <img src="https://seeklogo.com/images/C/commercial-bank-logo-9C9098B1B5-seeklogo.com.png?v=638406551990000000"
                     alt="Commercial Bank">
            </div>
            <div class="number">
                <span>**** **** **** 1060</span>
            </div>
            <div class="details">
                <span>Name: Kasun Mendis</span>
                <span>Branch: Panadura</span>
            </div>
        </div>
        <div class="payment-card-3">
            <div class="img-box">
                <img src="https://seeklogo.com/images/S/sampath-bank-plc-logo-3B2E87391B-seeklogo.com.png"
                     alt="Sampath bank">
            </div>
            <div class="number">
                <span>**** **** **** 1060</span>
            </div>
            <div class="details">
                <span>Name: Kasun Mendis</span>
                <span>Branch: Panadura</span>
            </div>
        </div>
    </div>

    <div class="payment-method">
        <h2>Add New Bank Account</h2>
        <div class="method">
            <h3>Bank Account</h3>
            <form class="payment-form">
                <label for="card-number">Bank Account Number: </label>
                <input type="text" id="card-number" placeholder="Enter bank account number">
                <label for="card-name">Bank Account Name: </label>
                <input type="text" id="card-name" placeholder="Enter bank account name">
                <label for="card-name">Bank Branch: </label>
                <input type="text" id="card-name" placeholder="Enter bank branch">
                <button type="button">Add New Bank Account</button>
            </form>
        </div>
    </div>

</section>

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
<script src="/js/technician/overlay.js"></script>

</body>
</html>