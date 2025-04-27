<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/admin/customers.css">
    <link rel="stylesheet" href="/css/admin/admin-dashboard.css">
    <link rel="stylesheet" href="/css/admin/admin-add-vehicle-type-issue.css">
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
                <th>Edit Issue</th>
                <th>Remove Issue</th>
            </tr>
            </thead>
            <tbody id="table-body">
            <?php if (!empty($issueTypes)): ?>
                <?php foreach ($issueTypes as $issueType): ?>
                    <tr>
                        <td><?= htmlspecialchars($issueType['issue_id']) ?></td>
                        <td><?= ucwords(htmlspecialchars($issueType['issue_type'])) ?></td>
                        <td>
                            <form action="/admin-edit-vehicle-type-issue">
                                <button type="submit" class="btn-update" name="issue_id"
                                        value="<?= $issueType['issue_id'] ?>">
                                    Edit
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="/admin-remove-vehicle-type-issue" method="post">
                                <button type="submit" class="issue-id" name="issue_id"
                                        value="<?= $issueType['issue_id'] ?>">
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

        <form id="vehicle-type-form" action="/admin-add-vehicle-type-issue" method="POST">
            <label for="vehicle-issue-type">Issue Type:</label>
            <input type="text" class="vehicle-issue-type-input" name="issue_type" required>
            <button type="submit" class="btn-update">Add Vehicle Issue Type</button>
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
