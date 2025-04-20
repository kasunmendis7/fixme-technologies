<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/admin/customers.css">
    <link rel="stylesheet" href="/css/admin/admin-dashboard.css">
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
                <th>Technician ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Bank Account Number</th>
                <th>Bank Account Name</th>
                <th>Bank Account Branch</th>
            </tr>
            </thead>
            <tbody id="table-body">
            <?php if (!empty($bankAccounts)): ?>
                <?php foreach ($bankAccounts as $bankAccount): ?>
                    <tr data-technician-id="<?= htmlspecialchars($bankAccount['tech_id']) ?>">
                        <td><?= htmlspecialchars($bankAccount['tech_id']) ?></td>
                        <td><?= htmlspecialchars($bankAccount['fname']) ?></td>
                        <td><?= htmlspecialchars($bankAccount['lname']) ?></td>
                        <td><?= htmlspecialchars($bankAccount['bank_acc_num']) ?></td>
                        <td><?= htmlspecialchars($bankAccount['bank_acc_name']) ?></td>
                        <td><?= htmlspecialchars($bankAccount['bank_acc_branch']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No Bank Accounts Found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
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
</div>

<script src="/js/admin/technicians.js"></script>
<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
