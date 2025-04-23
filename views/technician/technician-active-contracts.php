<?php

/**
 * @var $activeContracts
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technician Active Contracts</title>
    <link rel="stylesheet" href="/css/technician/technician-dashboard.css">
    <link rel="stylesheet" href="/css/technician/technician-active-contracts.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">

</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<div class="details">
    <div class="activeContracts">
        <div class="cardHeader">
            <h2 class="heading">Active Contracts</h2>
        </div>

        <table class="modern-table active-contracts-table">
            <thead>
            <tr>
                <th>Customer Image</th>
                <th>Customer Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($activeContracts)): ?>
                <?php foreach ($activeContracts as $contract): ?>
                    <tr>
                        <td>
                            <img src="<?= htmlspecialchars($contract['profile_picture']) ?>" alt="Customer Image"
                                 class="customer-image"/>
                        </td>
                        <td><?= htmlspecialchars($contract['customer_name']) ?></td>
                        <td>
                            <a href="/technician-active-contract-details/<?= $contract['contract_id'] ?>"
                               class="open-contract-btn">Open Contract</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">No Active Contracts</td>
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
