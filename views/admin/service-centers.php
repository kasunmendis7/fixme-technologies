<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/admin/customers.css">
    <link rel="stylesheet" href="/css/admin/admin-dashboard.css">
    <title>Admin service center management</title>
</head>
<body>

<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<div class="customers-container">

    <div id="customers-table">
        <table class="table">
            <thead>
            <tr>
                <th>Service Center ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Registered Date</th>
            </tr>
            </thead>
            <tbody id="table-body">
            <?php if (!empty($serviceCentres)): ?>
                <?php foreach ($serviceCentres as $serviceCentres): ?>
                    <tr data-service_Centre-id="<?= htmlspecialchars($serviceCentres['ser_cen_id']) ?>">
                        <td><?= htmlspecialchars($serviceCentres['ser_cen_id']) ?></td>
                        <td><?= htmlspecialchars($serviceCentres['name']) ?></td>
                        <td><?= htmlspecialchars($serviceCentres['email']) ?></td>
                        <td><?= htmlspecialchars($serviceCentres['phone_no']) ?></td>
                        <td><?= htmlspecialchars($serviceCentres['address']) ?></td>
                        <td><?= htmlspecialchars($serviceCentres['reg_date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No Service Centers found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <p id="no-packages-message" style="display: none;">You have no packages yet!</p>
    </div>
</div>

<script src="/js/admin/technicians.js"></script>
<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>