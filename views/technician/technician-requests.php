<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technician Dashboard</title>
    <link rel="stylesheet" href="/css/technician/technician-requests.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">
</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<!-- JavaScript Files -->
<script src="/js/technician/technician-home.js"></script>

<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Recent Requests</h2>
        </div>
        <table>
            <thead>
            <tr>
                <td>Customer ID</td>
                <td>Customer Name</td>
                <td>Status</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($requests as $request): ?>
                <tr>
                    <td><?= $request['cus_id'] ?></td>
                    <td><?= $request['cus_name'] ?></td>
                    <td>
                        <span class="status <?= strtolower($request['status']) ?>"><?= ucfirst($request['status']) ?></span>
                    </td>
                    <td>
                        <?php if ($request['status'] == 'Pending' || $request['status'] == 'pending'): ?>
                            <form action="/technician-requests-update" method="POST" style="display:inline;">
                                <input type="hidden" name="req_id" value="<?= $request['req_id'] ?>">
                                <input type="hidden" name="status" value="InProgress">
                                <button type="submit" class="btn accept">Accept</button>
                            </form>
                            <form action="/technician-requests-update" method="POST" style="display:inline;">
                                <input type="hidden" name="req_id" value="<?= $request['req_id'] ?>">
                                <input type="hidden" name="status" value="Rejected">
                                <button type="submit" class="btn reject">Reject</button>
                            </form>
                        <?php else: ?>
                            <?php if ($request['status'] == 'InProgress'): ?>
                                <span><button class="view-on-map" onclick="window.location.href='/technician-map'">View On Map</button></span>
                            <?php else: ?>
                                <span>Request Rejected</span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
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
