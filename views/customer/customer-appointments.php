<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer appointment details</title>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/customer/flash-messages.css">
    <link rel="stylesheet" href="/css/customer/customer-appointment.css">
</head>

<body>

    <?php
    include_once 'components/sidebar.php';
    include_once 'components/header.php';

    ?>

    <h2 class="appointment-header" style="margin-top: 5%;">Appointments</h2>

    <div class="customer-appointments-section">
        <?php if (isset($appointments) && is_array($appointments) && count($appointments) > 0): ?>
            <div class="table-wrapper">
                <table class="customer-appointments-table">
                    <thead>
                        <tr>
                            <th>Service Center Name</th>
                            <th>Phone No</th>
                            <th>Vehicle</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>OTP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $appointment): ?>
                            <tr class="fade-in">
                                <td><?= htmlspecialchars($appointment['service_center_name']) ?></td>
                                <td><?= htmlspecialchars($appointment['service_center_phone_no']) ?></td>
                                <td><?= htmlspecialchars($appointment['vehicle_details']) ?></td>
                                <td><?= htmlspecialchars($appointment['appointment_date']) ?></td>
                                <td><?= htmlspecialchars($appointment['appointment_time']) ?></td>
                                <td>
                                    <?php
                                    $status = strtolower($appointment['status']);
                                    $statusClass = match ($status) {
                                        'completed' => 'badge-completed',
                                        'pending' => 'badge-pending',
                                        'cancelled' => 'badge-cancelled',
                                        default => 'badge-default',
                                    };
                                    ?>
                                    <span
                                        class="badge <?= $statusClass ?>"><?= htmlspecialchars($appointment['status']) ?></span>
                                </td>
                                <td>
                                    <?php if (!empty($appointment['otp'])): ?>
                                        <span class="badge badge-otp-sent"><?= htmlspecialchars($appointment['otp']) ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-otp-not-sent">Not Set</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No appointments found.</p>
        <?php endif; ?>
    </div>


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="/js/customer/customer-dashboard.js"></script>
    <script src="/js/customer/customer-home.js"></script>
    <script src="/js/customer/overlay.js"></script>

</body>

</html>