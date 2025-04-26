<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/admin/customers.css">
    <link rel="stylesheet" href="/css/admin/admin-dashboard.css">
    <link rel="stylesheet" href="/css/admin/admin-add-vehicle-type.css">
    <title>Admin Dashboard</title>
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
                <th>Vehicle ID</th>
                <th>Vehicle Type</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="table-body">
            <?php if (!empty($vehicleTypes)): ?>
                <?php foreach ($vehicleTypes as $vehicleType): ?>
                    <tr>
                        <td><?= htmlspecialchars($vehicleType['vehicle_id']) ?></td>
                        <td><?= ucwords(htmlspecialchars($vehicleType['vehicle_type'])) ?></td>
                        <td>
                            <form action="/admin-remove-vehicle-type" method="post">
                                <button type="submit" class="vehicle-id" name="vehicle_id"
                                        value="<?= $vehicleType['vehicle_id'] ?>">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No Vehicle Types Found.</td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>
    </div>
    <div class="vehicle-type-container">

        <form id="vehicle-type-form" action="/admin-add-vehicle-type" method="POST">
            <label for="vehicle-type">Vehicle Type:</label>
            <input type="text" class="vehicle-type-input" name="vehicle_type" required>
            <button type="submit" class="btn-update">Add Vehicle Type</button>
        </form>

    </div>
    <!-- Modal -->
    <div id="delete-modal" class="modal hidden">
        <div class="modal-content">
            <h3>Are you sure you want to delete this technician?</h3>
            <div class="modal-buttons">
                <button id="confirm-delete" class="button failure">Yes</button>
                <button id="cancel-delete" class="button gray">No, cancel</button>
            </div>
        </div>
    </div>

    <script src="/js/admin/overlay.js"></script>
    <!--    Icons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
