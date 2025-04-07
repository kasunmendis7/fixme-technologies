<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technician Dashboard</title>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/customer-payment-details.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">

</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<!-- JavaScript Files -->
<!-- ======================= Cards ================== -->

<form id="payment-form">
    <h2>Add Payment Method</h2>

    <label for="card-number">Card Number</label>
    <input type="text" id="card_number" name="card_number" placeholder="XXXX XXXX XXXX XXXX" required>

    <div style="display: flex; gap: 10px;">
        <div style="flex: 1;">
            <label for="expiry_date">Expiry Date</label>
            <input type="text" id="expiry_date" name="exp_date" placeholder="MM/YY" required>
        </div>
        <div style="flex: 1;">
            <label for="cvv">CVV</label>
            <input type="password" id="cvv" name="cvv" placeholder="***" maxlength="3" required>
        </div>
    </div>

    <label for="card_name">Name on Card</label>
    <input type="text" id="card_name" name="card_name" placeholder="Enter cardholder name" required>

    <button type="submit">Add Card</button>
</form>

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
<script src="/js/customer/customer-payment-details.js" defer></script>
<script src="/js/technician/overlay.js"></script>

</body>
</html>