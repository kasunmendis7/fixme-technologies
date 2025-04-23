<?php

/** @var $contract */

use app\core\Application;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Contract Details</title>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/customer/customer-active-contract-details.css">
</head>

<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<div class="contract-page">
    <div class="contract-header">
        <h2>Contract Details: #<?= htmlspecialchars($contract['contract_id']) ?></h2>
    </div>

    <!-- Timeline Section -->
    <div class="timeline">
        <!-- Step 1 -->
        <div class="timeline-step <?= $contract['status'] === 'pending' ? 'active' : ($contract['status'] !== 'finished' ? 'completed' : '') ?>">
            <div class="step-marker">1</div>
            <div class="step-content">
                <h3>Share PIN</h3>
                <p>Share this PIN with the technician to verify their arrival.</p>
                <?php if ($contract['status'] === 'pending'): ?>
                    <strong class="pin">PIN: <?= htmlspecialchars($contract['start_pin']) ?></strong>
                <?php endif; ?>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="timeline-step <?= $contract['status'] === 'ongoing' ? 'active' : ($contract['status'] === 'finished' ? 'completed' : '') ?>">
            <div class="step-marker">2</div>
            <div class="step-content">
                <h3>Ongoing</h3>
                <p>Technician is currently performing the work.</p>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="timeline-step <?= $contract['status'] === 'finished' ? 'completed active' : '' ?>">
            <div class="step-marker">3</div>
            <div class="step-content">
                <h3>Finish Contract</h3>
                <p>Finalize the contract by sharing an OTP with the technician.</p>
                <?php if ($contract['status'] === 'ongoing'): ?>
                    <button id="finish-contract-btn" class="action-button"
                            onclick="finishContract(<?= $contract['contract_id'] ?>)">Finish Contract
                    </button>
                <?php elseif ($contract['status'] === 'finished'): ?>
                    <p style="color: #0A1223; font-weight: bold; margin-top: 1rem">Finish PIN (OTP): </p>
                    <strong class="pin" id="pin">PIN: <?= htmlspecialchars($contract['finish_pin']) ?></strong>
                    <p class="success-message" style="color: #28a745; margin-top: 1rem; font-size: 1.5rem">This contract
                        is successfully
                        completed!</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Step 4 -->
        <?php if ($contract['status'] === 'finished'): ?>
            <div class="timeline-step">
                <div class="step-marker">4</div>
                <div class="step-content">
                    <h3>Review</h3>
                    <p>Rate the technician and leave a review.</p>
                    <button id="rate-technician-btn" class="action-button"
                            onclick="viewProfile(<?= $contract['tech_id'] ?>)">Rate Technician
                    </button>
                </div>
            </div>
        <?php endif; ?>
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
<script src="/js/customer/overlay.js"></script>
<script src="/js/customer/customer-active-contract-details.js"></script>
</body>

</html>
