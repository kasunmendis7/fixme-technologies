<?php

use app\models\CusTechAdvPayment;
use app\models\TechnicianReview;
use app\models\ServiceCenterReview;
use app\models\CusTechReq;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/css/admin/admin-dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
            href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap"
            rel="stylesheet"
    />
    <link rel="stylesheet" href="/css/admin/chart.css"/>
</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<!-- JavaScript Files -->
<script src="/js/admin/main.js"></script>
<!-- ======================= Cards ================== -->
<div class="cardBox">
    <div class="card">
        <div>
            <?php
            $ctr = new CusTechReq();
            $totalRequests = $ctr->countTotalRequests();
            ?>
            <div class="numbers"><?php echo $totalRequests ?></div>
            <div class="cardName">Total Requests</div>
        </div>

        <div class="iconBx">
            <ion-icon name="cog-outline"></ion-icon>
        </div>
    </div>
    <div class="card">
        <div>
            <?php
            $ctr = new CusTechReq();
            $totalPendingRequests = $ctr->countPendingTotalRequests();
            ?>
            <div class="numbers"><?php echo $totalPendingRequests ?></div>
            <div class="cardName">Total Pending Requests</div>
        </div>

        <div class="iconBx">
            <ion-icon name="hourglass-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <?php
            $tr = new TechnicianReview();
            $scr = new ServiceCenterReview();
            $totalTechnicianReviews = $tr->countTotalTechnicianReviews();
            $totalServiceCenterReviews = $scr->countTotalServiceCenterReviews();
            $totalReviews = $totalTechnicianReviews + $totalServiceCenterReviews;
            ?>
            <div class="numbers"><?php echo $totalReviews ?></div>
            <div class="cardName">Total Reviews & Ratings</div>
        </div>

        <div class="iconBx">
            <ion-icon name="pencil-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <?php
            $ctap = new CusTechAdvPayment();
            $advancePaymentEarning = $ctap->getTotalAdvancePaymentRevenue(); ?>
            <div class="numbers">Rs. <?php echo $advancePaymentEarning ?></div>
            <div class="cardName">Total Advance Payments</div>
        </div>

        <div class="iconBx">
            <ion-icon name="cash-outline"></ion-icon>
        </div>
    </div>
</div>

<div class="MainChart">

    <div class="Chart">
        <h1>Earnings(Past 12 Months)</h1>
        <div>
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <div class="Chart doughnut-chart">
        <h1>Employees</h1>
        <div>
            <canvas id="doughnut"></canvas>
        </div>
    </div>


</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/js/admin/main.js"></script>
<script src="/js/admin/chart.js"></script>
<script src="/js/admin/linegraph.js"></script>

</div>

<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>