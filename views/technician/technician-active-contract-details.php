<?php

/** @var $contract */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technician Active Contract Details</title>
    <link rel="stylesheet" href="/css/technician/technician-dashboard.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">
    <link rel="stylesheet" href="/css/technician/technician-active-contract-details.css">

</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<div class="contract-details-container">
    <!-- Page Header -->
    <div class="contract-header">
        <h2>Verify Contract Start PIN</h2>
    </div>

    <!-- Form Section -->
    <div class="contract-form">
        <p class="instruction">Please enter the PIN provided by the customer to verify that you have arrived at the
            location.</p>
        <form method="POST" action="/technician-contract-verify-start-pin">
            <input type="hidden" name="contract_id" value="<?= htmlspecialchars($contract['contract_id']) ?>">

            <div class="form-group">
                <label for="pin">Customer PIN</label>
                <input type="text" id="pin" name="pin" class="input-field" placeholder="Enter customer-provided PIN"
                       required>
            </div>

            <button type="submit" class="primary-btn">Verify PIN</button>
        </form>
    </div>

    <!-- Finish Contract Button -->
    <?php if ($contract['status'] === 'ongoing' || $contract['status'] === 'finished'): ?>
        <div class="finish-section">
            <form method="POST" action="/technician-finish-contract">
                <input type="hidden" name="contract_id" value="<?= htmlspecialchars($contract['contract_id']) ?>">

                <div class="form-group" id="finish-pin-group">
                    <label for="finishPin">Enter Finish PIN</label>
                    <input type="text" id="finishPin" name="finish_pin" class="input-field"
                           placeholder="Enter Finish PIN" required>
                </div>

                <button type="submit" class="primary-btn finish-btn">Submit PIN & Finalize Contract</button>
            </form>
        </div>
    <?php endif; ?>

    <?php if ($contract['done'] === 'true'): ?>
        <div class="finished-section">
            <p class="success-msg">This contract has already been completed!</p>
        </div>
    <?php endif; ?>

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
<script src="/js/technician/overlay.js"></script>
<script src="/js/technician/technician-active-contract-details.js"></script>

</body>
</html>
