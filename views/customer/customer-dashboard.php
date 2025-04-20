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
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/customer/flash-messages.css">
</head>

<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<!-- ======================= Cards ================== -->
<?php if (Application::$app->session->getFlash('deleteCusTechReq-success')): ?>
    <div class="alert alert-success">
        <?php echo Application::$app->session->getFlash('deleteCusTechReq-success') ?>
    </div>
<?php endif; ?>
<?php if (Application::$app->session->getFlash('deleteCusTechReq-error')): ?>
    <div class="alert alert-error">
        <?php echo Application::$app->session->getFlash('deleteCusTechReq-error') ?>
    </div>
<?php endif; ?>
<div class="cardBox">
    <div class="card" onclick="getAdvancePayments(<?php echo Application::$app->session->get('customer') ?>)">
        <div>
            <?php
            $ctap = new CusTechAdvPayment();
            $advancePaymentCount = $ctap->countAdvancePayment(Application::$app->session->get('customer'));
            ?>
            <div class="numbers"><?php echo $advancePaymentCount ?></div>
            <div class="cardName">Advance Payments</div>
        </div>

        <div class="iconBx">
            <ion-icon name="cog-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers">2</div>
            <div class="cardName">Level</div>
        </div>

        <div class="iconBx">
            <ion-icon name="trophy-outline"></ion-icon>

        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers">20</div>
            <div class="cardName">Total Reviews</div>
        </div>

        <div class="iconBx">
            <ion-icon name="star-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers">Rs. 7,842</div>
            <div class="cardName">Payments</div>
        </div>

        <div class="iconBx">
            <ion-icon name="cash-outline"></ion-icon>
        </div>
    </div>
</div>

<!-- ================ Request Details List ================= -->
<div class="details">
    <div class="recentRequests">
        <div class="cardHeader">
            <h2>Recent Requests</h2>
        </div>

        <table>
            <thead>
            <tr>
                <td>Name</td>
                <td>Price</td>
                <td>Payment</td>
                <td></td>
                <td>Status</td>
            </tr>
            </thead>

            <tbody>
            <?php
            $ctr = new CusTechReq();
            $requests = $ctr->getAllRequests(Application::$app->session->get('customer'));
            foreach ($requests as $request) {
                echo '<tr>
                <td>' . $request['fname'] . ' ' . $request['lname'] . '</td>
                <td>Rs. ' . (is_null($request['amount']) ? '0.00' : number_format($request['amount'], 2)) . '</td>';

                echo '<td>';
                if ($request['status'] == 'pending') {
                    echo '<span class="payment-due">Payment Due !</span>';
                } else if ($request['status'] == 'InProgress') {
                    if ($request['done'] == 'true') {
                        echo '<span class="payment-status">Advance Paid ✔</span>';
                    } else {
                        echo '<span class="pay-now-btn"><a href="/customer-advance-payments">Pay Now</a></span>';
                    }
                } else {
                    echo '<span class="payment-rejected">-</span>';
                }
                echo '</td>';

                // Additional action cell: show cancel button if request is pending
                echo '<td>';
                if ($request['status'] == 'pending') {
                    echo '<span>
                      <button type="submit" class="cancel-btn" onclick="cancelReq(' . $request['cus_id'] . ',' . $request['tech_id'] . ')">
                          Cancel
                      </button>
                  </span>';
                }
                echo '</td>';

                // Status cell
                echo '<td>
                <span class="status ' . strtolower($request['status']) . '">
                    ' . ucfirst($request['status']) . '
                </span>
              </td>
             </tr>';
            }
            ?>
            </tbody>

        </table>
    </div>

    <!-- ================= Recent Technicians ================ -->
    <div class="recentTechnicians">
        <div class="cardHeader">
            <h2>Recent Technicians</h2>
        </div>

        <table>
            <?php
            $ctr = new CusTechReq();
            $recentTechnicians = $ctr->getRecentTechnicians(Application::$app->session->get('customer'));
            foreach ($recentTechnicians as $recentTechnician) {
                echo
                    '
                        <tr>
                            <td>
                                <div class="imgBx"><img src="' . $recentTechnician['profile_picture'] . '" alt="Technician profile-pic"></div>
                            </td>
                            <td>
                                <h4>' . $recentTechnician['fname'] . ' ' . $recentTechnician['lname'] . '  <br> <span>Technician</span></h4>
                            </td>
                        </tr>
                    ';
            }
            ?>

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
<script src="/js/customer/customer-dashboard.js"></script>
<script src="/js/customer/customer-home.js"></script>
<script src="/js/customer/overlay.js"></script>
</body>

</html>