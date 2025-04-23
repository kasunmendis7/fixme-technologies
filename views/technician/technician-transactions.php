<?php

use app\core\Application;
use app\models\CusTechReq;
use app\models\CusTechAdvPayment;

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
            <?php

            $earning = number_format($revenue * (80 / 100), 2, '.', ',');
            ?>
            <div class="total-payments">
                <p>Total Earnings</p>
                <h2>LKR <?php echo $earning ?></h2>
                <small>as of <?php echo date('d-F-Y') ?></small>
                <small></small>
            </div>
        </div>
        <div class="header-item">
            <?php
            $pending = number_format($totalPending * (80 / 100), 2, '.', ',');
            ?>
            <div class="pending-payments">
                <p>Pending Payments</p>
                <h2>LKR <?php echo $pending ?></h2>
                <small>as of <?php echo date('d-F-Y') ?></small>
            </div>
        </div>
    </div>

    <div class="payment-history">
        <h3>Payment History</h3>
        <table>
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($transactions)): ?>
                <?php foreach ($transactions as $transaction): ?>
                    <?php
                    $status = strtolower($transaction['done']);
                    $statusClass = $status === 'true' ? 'success' : ($status === 'false' ? 'pending' : 'pending');
                    $formattedDate = date('M j, Y', strtotime($transaction['time']));
                    ?>
                    <tr>
                        <td>#<?= htmlspecialchars($transaction['req_id']) ?></td>
                        <td><?= $formattedDate ?></td>
                        <td>LKR <?= number_format($transaction['amount'], 2, '.', ',') ?></td>
                        <td class="<?= $statusClass ?>">
                            <?= ucfirst($statusClass) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">No transactions found.</td>
                </tr>
            <?php endif; ?>
            </tbody>

        </table>
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
