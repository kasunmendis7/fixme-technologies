<?php

use app\core\Application;

/** @var $contract */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Finished Contracts</title>
    <link rel="stylesheet" href="/css/technician/technician-dashboard.css">
    <link rel="stylesheet" href="/css/technician/technician-finished-contract-details.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">
    <link rel="stylesheet" href="/css/technician/flash-messages.css">
</head>

<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<div class="invoice-container">
    <div class="invoice-header">
        <h1>Contract Invoice</h1>
        <p>Thank you for trusting our services. Below are the details of your finished contract.</p>
    </div>

    <!-- Contract Details -->
    <div class="invoice-details">
        <div class="invoice-section">
            <h2>Technician Information</h2>
            <p><strong>Name:</strong> <?= htmlspecialchars($contract['technician_name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($contract['technician_email']) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($contract['technician_phone']) ?></p>
            <p><strong>Bank Account Number:</strong> <?= htmlspecialchars($contract['bank_account_num']) ?></p>
            <p><strong>Bank Account Name:</strong> <?= htmlspecialchars($contract['bank_name']) ?></p>
            <p><strong>Bank Account Branch:</strong> <?= htmlspecialchars($contract['bank_branch']) ?></p>
        </div>

        <div class="invoice-section">
            <h2>Customer Information</h2>
            <p><strong>Customer Name:</strong> <?= htmlspecialchars($contract['customer_name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($contract['customer_email']) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($contract['customer_phone']) ?></p>
        </div>

        <div class="invoice-section">
            <h2>Contract Information</h2>
            <p><strong>Contract ID:</strong> <?= htmlspecialchars($contract['contract_id']) ?></p>
            <p><strong>Start Date/Time:</strong> <?= htmlspecialchars($contract['start_time']) ?></p>
            <p><strong>End Date/Time:</strong> <?= htmlspecialchars($contract['end_time']) ?></p>
            <p><strong>Status:</strong> Finished</p>
        </div>
    </div>

    <!-- Pricing Information -->
    <div class="invoice-summary">
        <h2>Pricing Summary</h2>
        <table>
            <thead>
            <tr>
                <th>Description</th>
                <th>Amount (LKR)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Payment Recieved</td>
                <td>Rs. <?= htmlspecialchars($contract['customer_payment']) ?></td>
            </tr>
            <tr>
                <td>Service Charge(20% of the Payment Recieved)</td>
                <td>- Rs. <?= htmlspecialchars($contract['service_charge']) ?></td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td>Rs. <strong><?= htmlspecialchars($contract['total_cost']) ?></strong></td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="invoice-footer">
        <p>If you have any questions or require assistance, please contact our customer support. Thank you for using our
            service!</p>
        <button class="download-invoice-btn" onclick="downloadInvoice()">Download Invoice</button>
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
<script src="/js/technician/overlay.js"></script>
<script src="/js/technician/technician-finished-contract-details.js"></script>
</body>

</html>
