<?php

use app\core\Application;
use app\models\CusTechReq;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/customer/flash-messages.css">
    <link rel="stylesheet" href="/css/customer/customer-vehicle-issue.css">
</head>

<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<body>
<div class="form-container">
    <h1 class="form-title">Report Your Vehicle Issue</h1>
    <form id="vehicleForm" class="vehicle-form">
        <label for="vehicleType" class="label">Select Vehicle Type:</label>
        <select id="vehicleType" name="vehicleType" class="dropdown" required>
            <option value="" disabled selected>Select a vehicle</option>
            <option value="motorbike">Motorbike</option>
            <option value="tuk-tuk">Tuk-Tuk</option>
            <option value="car">Car</option>
        </select>

        <label for="selectIssue" class="label">Select Issue:</label>
        <select id="selectIssue" name="selectIssue" class="dropdown" required>
            <option value="" disabled selected>Select an issue</option>
            <option value="battery">Battery Issue</option>
            <option value="engine">Engine Problem</option>
            <option value="brakes">Brake Issue</option>
            <option value="other">Other</option>
        </select>

        <label for="technicianCare" class="label">How much do you care about the nearest technician?</label>
        <select id="technicianCare" name="technicianCare" class="dropdown" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label for="ratingCare" class="label">How much do you care about the technician's rating?</label>
        <select id="ratingCare" name="ratingCare" class="dropdown" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <button type="submit" class="submit-button">Get Recommended Technician</button>
    </form>
</div>
</body>
<!-- Overlay for the confirmation message -->
<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/customer-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>
<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/customer/customer-dashboard.js"></script>
<script src="/js/customer/customer-home.js"></script>
<script src="/js/customer/overlay.js"></script>
<script src="/js/customer/customer-vehicle-issue.js"></script>
</body>

</html>
