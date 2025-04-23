<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Select Specializations</title>
    <link rel="stylesheet" href="/css/technician/technician-specialization.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">
</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<form action="/technician-update-specialization" method="POST">
    <h1>Select Your Specializations</h1>

    <input type="hidden" name="tech_id" value="<?= $technicianId ?? '' ?>">

    <?php if (!empty($specializations)): ?>
        <fieldset>
            <legend>🛠 Available Specializations</legend>
            <?php foreach ($specializations as $spec): ?>
                <?php $specilization = ucwords($spec['tech_spec_type']); ?>
                <label>
                    <input type="checkbox" name="specializations[]" value="<?= $spec['tech_spec_cat_id'] ?>">
                    <?= htmlspecialchars($specilization) ?>
                </label><br>
            <?php endforeach; ?>
        </fieldset>
    <?php else: ?>
        <p>No specializations found.</p>
    <?php endif; ?>
    <br>
    <button type="submit">Save Specializations</button>
</form>

<!-- Icons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/customer/customer-home.js"></script>
<script src="/js/technician/overlay.js"></script>
<script src="/js/technician/technician-specialization.js"></script>
</body>
</html>
