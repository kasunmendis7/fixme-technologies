<?php

/** @var $status */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Availability</title>
    <link rel="stylesheet" href="/css/technician/technician-dashboard.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">
    <link rel="stylesheet" href="/css/technician/technician-availability.css"
</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<?php

$currentStatus = $status['available'] == 'true' ? 'Available' : 'Not Available';
$currentStatusClass = ($currentStatus == 'Available' ? 'status-available' : 'status-not-available');
?>

<div class="availability-container">

    <h2>Update Your Availability</h2>

    <!-- Section to Display Current Status -->
    <div class="current-status <?php echo $currentStatusClass; ?>">
        <p>Current Status: <strong><?php echo $currentStatus; ?></strong></p>
    </div>

    <h2>Update Your Availability</h2>
    <form id="availability-form" action="/technician-update-availability" method="post">
        <label for="availability-status">Select Status</label>
        <select name="status" id="availability-status">
            <option value="available">Available</option>
            <option value="not_available">Not Available</option>
        </select>
        <button type="submit" class="btn-update">Update Status</button>
    </form>
</div>

<!-- Overlay for the confirmation message -->
<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/technician-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>
<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/technician/overlay.js"></script>

</body>
</html>
