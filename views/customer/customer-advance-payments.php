<?php

/** @var $adv_payments \app\models\CusTechAdvPayment */

use app\core\Application;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Advance Payments</title>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/customer/flash-messages.css">
    <link rel="stylesheet" href="/css/customer/customer-advance-payments.css">
</head>

<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<div class="details">
    <div class="advancePayments">
        <div class="cardHeader">
            <h2 class="heading">Pending Advance Payments</h2>
        </div>

        <table class="modern-table advance-payments-table">
            <thead>
            <tr>
                <th>Pin</th>
                <th>Technician Name</th>
                <th>Amount (Rs.)</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($adv_payments)): ?>
                <?php foreach ($adv_payments as $payment): ?>
                    <tr>
                        <td><?= $payment['pin'] ?></td>
                        <td><?= $payment['name'] ?></td>
                        <td><?= number_format($payment['amount'], 2) ?></td>
                        <td>
                            <button class="pay-now-btn"
                                    onclick="paymentGateWay(<?= $payment['cus_id'] ?>,<?= $payment['tech_id'] ?>);">
                                Pay Now
                            </button>
                            <button class="reject-btn" onclick="rejectPayment(<?= $payment['req_id'] ?>)">
                                Reject
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;">No pending payments</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

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
<script src="/js/customer/customer-advance-payments.js"></script>
<script src="/js/customer/customer-home.js"></script>
<script src="/js/customer/overlay.js"></script>
<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>
