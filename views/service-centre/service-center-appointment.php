<?php

use app\core\Application;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" href="/css/technician/technician-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/service-center/appointment-table.css">
    <link rel="stylesheet" href="/css/service-center/notification.css">
    <link rel="stylesheet" href="/css/customer/flash-messages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>


<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<?php if (Application::$app->session->getFlash('success')): ?>
    <div class="alert alert-success">
        <?php echo Application::$app->session->getFlash('success') ?>
    </div>
<?php elseif (Application::$app->session->getFlash('error')): ?>
    <div class="alert alert-error">
        <?php echo Application::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>

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

<div class="appointments-section">
    <h2>Appointments</h2>

    <?php if (isset($appointments) && is_array($appointments) && count($appointments) > 0): ?>
        <div class="appointment-cards">
            <?php foreach ($appointments as $appointment): ?>
                <div class="appointment-card">
                    <h3>
                        <ion-icon name="person-outline"></ion-icon>
                        <?= htmlspecialchars($appointment['customer_fname']) . ' ' . htmlspecialchars($appointment['customer_lname']) ?>
                    </h3>

                    <div class="appointment-info">
                        <ion-icon name="call-outline"></ion-icon>
                        <span><?= htmlspecialchars($appointment['customer_phone_no']) ?></span>
                    </div>

                    <div class="appointment-info">
                        <ion-icon name="car-sport-outline"></ion-icon>
                        <span><?= htmlspecialchars($appointment['vehicle_details']) ?></span>
                    </div>

                    <div class="appointment-info">
                        <ion-icon name="calendar-outline"></ion-icon>
                        <span><?= htmlspecialchars($appointment['appointment_date']) ?></span>
                    </div>

                    <div class="appointment-info">
                        <ion-icon name="time-outline"></ion-icon>
                        <span><?= htmlspecialchars($appointment['appointment_time']) ?></span>
                    </div>

                    <div class="appointment-info">
                        <ion-icon name="pricetag-outline"></ion-icon>
                        <span class="status-badge status-<?= htmlspecialchars($appointment['status']) ?>">
                                <?= ucfirst($appointment['status']) ?>
                            </span>
                    </div>

                    <div class="card-actions">
                        <form action="/change-appointment-status" method="post" class="form-section">
                            <input type="hidden" name="appointment_id" value="<?= $appointment['appointment_id'] ?>">
                            <select name="status" class="status-select"
                                    data-otp-id="otp-<?= $appointment['appointment_id'] ?>">
                                <option value="pending" <?= $appointment['status'] === 'pending' ? 'selected' : '' ?>>
                                    Pending
                                </option>
                                <option value="confirmed" <?= $appointment['status'] === 'confirmed' ? 'selected' : '' ?>>
                                    Confirmed
                                </option>
                                <option value="cancelled" <?= $appointment['status'] === 'cancelled' ? 'selected' : '' ?>>
                                    Cancelled
                                </option>
                            </select>
                            <input type="text" name="otp" placeholder="Enter OTP"
                                   id="otp-<?= $appointment['appointment_id'] ?>" class="otp-field"
                                   style="display: none;">
                            <button type="submit">Update</button>
                        </form>

                        <form action="/delete-appointment" method="post">
                            <input type="hidden" name="appointment_id" value="<?= $appointment['appointment_id'] ?>">
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No appointments found.</p>
    <?php endif; ?>
</div>
<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/technician-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>
<!-- Ionicons for icons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


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