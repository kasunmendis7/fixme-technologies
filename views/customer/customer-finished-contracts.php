<?php

/** @var $finishedContracts */

use app\core\Application;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Finished Contracts</title>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/customer-finished-contracts.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/customer/flash-messages.css">
</head>

<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<div class="details">
    <div class="activeContracts">
        <div class="cardHeader">
            <h2 class="heading">Finished Contracts</h2>
        </div>

        <table class="modern-table active-contracts-table">
            <thead>
            <tr>
                <th>Contract ID</th>
                <th>Technician Image</th>
                <th>Technician Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($finishedContracts)): ?>
                <?php foreach ($finishedContracts as $contract): ?>
                    <tr>
                        <td><?= htmlspecialchars($contract['contract_id']) ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($contract['profile_picture']) ?>" alt="Techinician Image"
                                 class="customer-image"/>
                        </td>
                        <td><?= htmlspecialchars($contract['technician_name']) ?></td>
                        <td>
                            <a href="/customer-finished-contract-details/<?= $contract['contract_id'] ?>"
                               class="open-contract-btn">View Contract</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">No Finished Contracts</td>
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
<script src="/js/customer/overlay.js"></script>
</body>

</html>
