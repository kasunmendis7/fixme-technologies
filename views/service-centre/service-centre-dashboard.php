<?php

use app\core\Application;
use app\models\ServiceCenterReview;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Center Dashboard</title>
    <link rel="stylesheet" href="/css/technician/technician-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/service-center/appointment-table.css">
    <link rel="stylesheet" href="/css/service-center/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <?php
    include_once 'components/sidebar.php';
    include_once 'components/header.php';
    ?>
    <!-- JavaScript Files -->
    <script src="/js/technician/technician-home.js"></script>
    <!-- ======================= Cards ================== -->

    <?php if (Application::$app->session->getFlash('success')): ?>
        <div class="alert alert-success">
            <?php echo Application::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <div class="cardBox">
        <div class="card">
            <div>
                <div class="numbers"><?php echo htmlspecialchars($totalCompleted); ?></div>
                <div class="cardName">Total Repairs</div>
            </div>

            <div class="iconBx">
                <ion-icon name="cog-outline"></ion-icon>
            </div>
        </div>

        <?php
        $level = 0;
        if ($totalCompleted >= 10 && $totalCompleted < 20) {
            $level = 1;
        } elseif ($totalCompleted >= 20 && $totalCompleted < 30) {
            $level = 2;
        } elseif ($totalCompleted >= 30 && $totalCompleted < 40) {
            $level = 3;
        } elseif ($totalCompleted >= 40 && $totalCompleted < 50) {
            $level = 4;
        } elseif ($totalCompleted >= 50) {
            $level = 5;
        }
        ?>

        <div class="card">
            <div>
                <div class="numbers"><?= $level ?></div>
                <div class="cardName">Level</div>
            </div>

            <div class="iconBx">
                <ion-icon name="trophy-outline"></ion-icon>

            </div>
        </div>

        <div class="card">
            <div>
                <?php
                $serviceCenterReviews = new ServiceCenterReview();
                $totalReviews = $serviceCenterReviews->countTotalReviewsByServiceCenterId(Application::$app->session->get('serviceCenter'));
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
            <div class="numbers"><?php echo 'Rs. ' . number_format($totalEarning); ?></div>
            <div class="cardName">Earning</div>
        </div>

        <div class="iconBx">
            <ion-icon name="cash-outline"></ion-icon>
        </div>
    </div>
    </div>

    <!-- appointment details -->
    <!-- <div class="appointments-section">
        <h2>Appointments</h2>

        <?php if (isset($appointments) && is_array($appointments) && count($appointments) > 0): ?>
            <table class="appointments-table">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>Vehicle Details</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?= htmlspecialchars($appointment['customer_fname']) ?>
                                <?= htmlspecialchars($appointment['customer_lname']) ?>
                            </td>
                            <td><?= htmlspecialchars($appointment['customer_phone_no']) ?></td>
                            <td><?= htmlspecialchars($appointment['vehicle_details']) ?></td>
                            <td><?= htmlspecialchars($appointment['appointment_date']) ?></td>
                            <td><?= htmlspecialchars($appointment['appointment_time']) ?></td>
                            <td>
                                <form action="/change-appointment-status" method="post"
                                    style="display: flex; flex-direction: column; gap: 6px;">
                                    <input type="hidden" name="appointment_id" value="<?= $appointment['appointment_id'] ?>">
                                    <select name="status" class="status-select" style="padding: 6px; border-radius: 4px;"
                                        data-otp-id="otp-<?= $appointment['appointment_id'] ?>">
                                        <option value="pending" <?= $appointment['status'] === 'pending' ? 'selected' : '' ?>>
                                            Pending</option>
                                        <option value="confirmed" <?= $appointment['status'] === 'confirmed' ? 'selected' : '' ?>>
                                            Confirmed</option>
                                        <option value="cancelled" <?= $appointment['status'] === 'cancelled' ? 'selected' : '' ?>>
                                            Cancelled</option>
                                    </select>
                                    <input type="text" name="otp" placeholder="Enter OTP"
                                        id="otp-<?= $appointment['appointment_id'] ?>" class="otp-field"
                                        style="padding: 6px; border: 1px solid #ccc; border-radius: 4px; display: none;">

                            </td>
                            <td>
                                <button type="submit"
                                    style="background-color: #0e4d92; color: #fff; padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer;">
                                    Update
                                </button>
                                </form>
                                <form action="/delete-appointment" method="post" style="display: inline;">
                                    <input type="hidden" name="appointment_id" value="<?= $appointment['appointment_id'] ?>">
                                    <button type="submit"
                                        style="background-color: #e84118; color: #fff; padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer;">
                                        Delete
                                    </button>
                                </form>
                            </td>


                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No appointments found.</p>
        <?php endif; ?>
    </div> -->


    <!-- ================ Order Details List ================= -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Recent Orders</h2>
                <a href="#" class="btn">View All</a>
            </div>
            <?php if ($completedAppointments): ?>
                <table>
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Date</td>
                            <td>Time</td>
                            <td>Status</td>
                        </tr>
                    </thead>

                    <?php foreach ($completedAppointments as $compeletedAppointment): ?>

                        <tbody>

                            <tr>
                                <td><?= htmlspecialchars($compeletedAppointment['fname']) ?>
                                    <?= htmlspecialchars($compeletedAppointment['lname']) ?>
                                </td>
                                <td><?= htmlspecialchars($compeletedAppointment['appointment_date']) ?></td>
                                <td><?= htmlspecialchars($compeletedAppointment['appointment_time']) ?></td>
                                <td>
                                    <span
                                        class="status inProgress"><?= htmlspecialchars($compeletedAppointment['status']) ?></span>
                                </td>
                            </tr>
                            <!-- <tr>
                        <td>Sheane Mario</td>
                        <td>Rs. 1200</td>
                        <td>Paid</td>
                        <td><span class="status delivered">Completed</span></td>
                    </tr>

                    <tr>
                        <td>Pulasthi Abhisheke</td>
                        <td>Rs. 110</td>
                        <td>Due</td>
                        <td><span class="status pending">Pending</span></td>
                    </tr>

                    <tr>
                        <td>Nimal Rathinarasa</td>
                        <td>Rs. 1200</td>
                        <td>-</td>
                        <td><span class="status return">Cancelled</span></td>
                    </tr>

                    <tr>
                        <td>Jimmy Donaldson</td>
                        <td>Rs. 620</td>
                        <td>Due</td>
                        <td><span class="status inProgress">In Progress</span></td>
                    </tr>

                    <tr>
                        <td>Erick Dodger</td>
                        <td>Rs. 1200</td>
                        <td>Paid</td>
                        <td><span class="status delivered">Completed</span></td>
                    </tr>

                    <tr>
                        <td>Steven Schaphiro Laptop</td>
                        <td>Rs. 110</td>
                        <td>Due</td>
                        <td><span class="status delivered">Completed</span></td>
                    </tr>

                    <tr>
                        <td>Dawson Smith</td>
                        <td>Rs. 1200</td>
                        <td>-</td>
                        <td><span class="status return">Cancelled</span></td>
                    </tr> -->
                        </tbody>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <div class="no-orders">
                    <p>No completed appointments found.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- ================= New Customers ================ -->
        <?php
        include_once 'components/recent-customers.php'
            ?>
    </div>


    <div id="signOutOverlay" class="overlay">
        <div class="overlay-content">
            <p>Are you sure you want to sign out?</p>
            <button id="confirmSignOut" class="btn"><a href="/service-center-logout"></a> Yes</button>
            <button id="cancelSignOut" class="btn">No</button>
        </div>
    </div>
    <!--    Icons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="/js/service-center/overlay.js"></script>

    <script>
        document.querySelectorAll('.status-select').forEach(select => {
            const otpInputId = select.dataset.otpId;
            const otpInput = document.getElementById(otpInputId);

            function toggleOtpField() {
                if (select.value === 'confirmed') {
                    otpInput.style.display = 'block';
                    otpInput.setAttribute('required', 'required');
                } else {
                    otpInput.style.display = 'none';
                    otpInput.removeAttribute('required');
                }
            }

            // Initial check
            toggleOtpField();

            // On change event
            select.addEventListener('change', toggleOtpField);
        });
    </script>


</body>

</html>