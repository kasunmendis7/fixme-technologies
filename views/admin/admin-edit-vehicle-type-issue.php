<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/admin/customers.css">
    <link rel="stylesheet" href="/css/admin/admin-dashboard.css">
    <link rel="stylesheet" href="/css/admin/admin-add-vehicle-type-issue.css">
    <title>Edit Vehicle Issue Type</title>
</head>
<body>

<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<div class="vehicle-type-container">
    <h2>Edit Vehicle Issue Type</h2>

    <form id="vehicle-type-form" action="/admin-edit-vehicle-type-issue" method="POST">
        <input type="hidden" name="issue_id" value="<?= htmlspecialchars($issueType['issue_id']) ?>">

        <label for="vehicle-issue-type">Issue Type:</label>
        <input type="text" class="vehicle-issue-type-input" name="issue_type"
               value="<?= htmlspecialchars($issueType['issue_type']) ?>" required>

        <button type="submit" class="btn-update">Save Changes</button>
    </form>

</div>

<script src="/js/admin/overlay.js"></script>
</body>
</html>
