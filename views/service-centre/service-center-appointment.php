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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php
        include_once 'components/sidebar.php';
        include_once 'components/header.php';
    ?>
<div class="appointments-section">
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
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="/js/service-center/overlay.js"></script>
</body>
</html>