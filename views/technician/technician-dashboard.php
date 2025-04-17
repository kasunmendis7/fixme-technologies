<?php

use app\core\Application;
use app\models\CusTechReq;
use app\models\TechnicianReview;
use app\models\CusTechAdvPayment;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technician Dashboard</title>
    <link rel="stylesheet" href="/css/technician/technician-dashboard.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">

</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<!-- JavaScript Files -->
<script src="/js/technician/technician-home.js"></script>
<!-- ======================= Cards ================== -->
<div class="cardBox">
    <div class="card">
        <div>
            <?php
            $techOrders = new CusTechReq();
            $totalTechnicianRepairs = $techOrders->getTechnicianTotalRepairs(Application::$app->session->get('technician'));
            ?>
            <div class="numbers">
                <?php echo $totalTechnicianRepairs ?>
            </div>
            <div class="cardName">Total Requests</div>
        </div>

        <div class="iconBx">
            <ion-icon name="cog-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <?php
            $techOrders = new CusTechReq();
            $totalTechnicianRepairs = $techOrders->getTechnicianRejectedRepairs(Application::$app->session->get('technician'));
            ?>
            <div class="numbers"><?php echo $totalTechnicianRepairs ?></div>
            <div class="cardName">Total Rejected</div>
        </div>

        <div class="iconBx">
            <ion-icon name="trophy-outline"></ion-icon>

        </div>
    </div>

    <div class="card">
        <div>
            <?php
            $techReviews = new TechnicianReview();
            $totalReviews = $techReviews->countTotalReviewsByTechnicianId(Application::$app->session->get('technician'));
            ?>
            <div class="numbers" id="total_review"><?php echo $totalReviews ?></div>
            <div class="cardName">Total Reviews</div>
        </div>

        <div class="iconBx">
            <ion-icon name="star-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <?php
            $ctap = new CusTechAdvPayment();
            $earning = $ctap->getTotalEarning(Application::$app->session->get('technician'));
            ?>
            <div class="numbers">Rs. <?php echo $earning ?></div>
            <div class="cardName">Total Earnings</div>
        </div>

        <div class="iconBx">
            <ion-icon name="cash-outline"></ion-icon>
        </div>
    </div>
</div>

<!-- ================ Order Details List ================= -->
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Recent Orders</h2>
        </div>

        <table>
            <thead>
            <tr>
                <td>Name</td>
                <td>Price</td>
                <td>Payment</td>
                <td>Status</td>
            </tr>
            </thead>

            <tbody>
            <?php
            $techOrders = new CusTechReq();
            $requests = $techOrders->getAllTechnicianRequests(Application::$app->session->get('technician'));
            foreach ($requests as $request) {
                echo '<tr>
                <td>' . $request['fname'] . ' ' . $request['lname'] . '</td>
                <td>Rs. ' . (is_null($request['amount']) ? '0.00' : number_format($request['amount'], 2)) . '</td>';

                // Payment status column: display "Due" for pending requests or if advance is not paid.
                echo '<td>';
                if ($request['status'] == 'pending') {
                    echo '<span class="payment-due">Payment Due !</span>';
                } else {
                    if ($request['done'] == 'true') {
                        echo '<span class="payment-status">Advance Received ✔</span>';
                    } else {
                        echo '<span class="payment-rejected">-</span>';
                    }
                }
                echo '</td>';

                // Status column remains unchanged.
                echo '<td>
                <span class="status ' . strtolower($request['status']) . '">' . ucfirst($request['status']) . '</span>
              </td>
              </tr>';
            }
            ?>
            </tbody>

        </table>
    </div>

    <!-- ================= New Customers ================ -->
    <div class="recentCustomers">
        <div class="cardHeader">
            <h2>Recent Customers</h2>
        </div>

        <table>
            <?php
            $techOrders = new CusTechReq();
            $requests = $techOrders->getRecentCustomers(Application::$app->session->get('technician'));
            foreach ($requests as $recentCustomer) {
                echo '<tr>
                        <td>
                            <div class="imgBx"><img src="' . $recentCustomer['profile_picture'] . '" alt=""></div>
                        </td>
                        <td>
                            <h4>' . $recentCustomer['fname'] . ' ' . $recentCustomer['lname'] . '</h4>
                        </td>
                    </tr>';
            }
            ?>
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