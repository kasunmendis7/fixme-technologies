<?php

use app\core\Application;
use app\models\CusTechReq;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="/css/technician/technician-dashboard.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">
    <link rel="stylesheet" href="/css/technician/technician-transactions.css">
</head>

<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<div class="container">
    <div class="header">
        <div class="header-item">
            <div class="total-payments">
                <p>Total Payments</p>
                <h2>LKR 430.00</h2>
                <small>as of 01-August 2024</small>
            </div>
        </div>
        <div class="header-item">
            <div class="pending-payments">
                <p>Pending Payments</p>
                <h2>LKR 100.00</h2>
                <small>as of 01-August 2024</small>
            </div>
        </div>
    </div>

    <div class="payment-history">
        <h3>Payment History</h3>
        <div class="tabs">
            <button class="tab-button active">All</button>
            <button class="tab-button">Complete</button>
            <button class="tab-button">Pending</button>
            <button class="tab-button">Rejected</button>
        </div>

        <table>
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>#15267</td>
                <td>Mar 1, 2023</td>
                <td>LKR 100</td>
                <td>1502******4832</td>
                <td class="success">Success</td>
            </tr>
            <tr>
                <td>#153587</td>
                <td>Jan 26, 2023</td>
                <td>LKR 300</td>
                <td>1502******1132</td>
                <td class="success">Success</td>
            </tr>
            <tr>
                <td>#12436</td>
                <td>Feb 12, 2023</td>
                <td>LKR 100</td>
                <td>1256******4832</td>
                <td class="success">Success</td>
            </tr>
            <tr>
                <td>#16879</td>
                <td>Feb 12, 2023</td>
                <td>LKR 500</td>
                <td>1502******6789</td>
                <td class="success">Success</td>
            </tr>
            <tr>
                <td>#16378</td>
                <td>Feb 28, 2023</td>
                <td>LKR 500</td>
                <td>1502******4832</td>
                <td class="rejected">Rejected</td>
            </tr>
            <tr>
                <td>#16609</td>
                <td>March 13, 2023</td>
                <td>LKR 100</td>
                <td>1502******4832</td>
                <td class="pending">Pending</td>
            </tr>
            <tr>
                <td>#16907</td>
                <td>March 18, 2023</td>
                <td>LKR 100</td>
                <td>1502******4832</td>
                <td class="success">Success</td>
            </tr>
            </tbody>
        </table>

        <div class="pagination">
            <span>10 per page</span>
            <div class="page-info">
                <span>1 of 1 pages</span>
            </div>
        </div>
    </div>
</div>
<body>

</body>
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
<script src="/js/technician/technician-dashboard.js"></script>
<script src="/js/technician/technician-home.js"></script>
<script src="/js/technician/overlay.js"></script>
<script src="/js/technician/technician-transactions.js"></script>
</body>

</html>
