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

<form action="/technician-update-vehicle" method="POST">
    <h1>Select Your Vehicle Type</h1>

    <input type="hidden" name="tech_id" value="<?= $technicianId ?? '' ?>">

    <?php if (!empty($vehicles)): ?>
        <fieldset>
            <legend>🛠 Available Vehicle Types</legend>
            <?php foreach ($vehicles as $vehicle): ?>
                <?php $vehicleName = ucwords($vehicle['vehicle_type']); ?>
                <label>
                    <input type="checkbox" name="vehicles[]" value="<?= $vehicle['vehicle_id'] ?>">
                    <?= htmlspecialchars($vehicleName) ?>
                </label><br>
            <?php endforeach; ?>
        </fieldset>
    <?php else: ?>
        <p>No vehicles found.</p>
    <?php endif; ?>
    <br>
    <button type="submit">Next</button>
</form>

<!-- Icons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/customer/customer-home.js"></script>
<script src="/js/technician/overlay.js"></script>
<script src="/js/technician/technician-specialization.js"></script>
</body>
</html>
