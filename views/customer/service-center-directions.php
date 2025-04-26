<?php

use app\core\Application;

/**
 * @var $locations
 */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Center</title>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/customer/flash-messages.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" crossorigin="anonymous"/>
    <!-- adding the css styling -->
</head>

<body>
<?php

include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<script>
    const locations = <?= json_encode($locations) ?>
</script>
<div id="map" style="width: 100%; height: 75vh;">
    <!-- map goes here -->
</div>
<!-- Travel Information Section -->
<div id="travel-info" style="display: flex; justify-content: center; margin: 1em 0;">
    <div style="text-align: center; padding: 20px; border-radius: 12px; box-shadow: 0px 4px 6px rgba(0,0,0,0.2); background-color: #FFFFFF; min-width: 300px;">
        <h2 style="font-size: 1.25em; margin-bottom: 10px;">Travel Information</h2>
        <p id="travel-distance" style="font-size: 1em; color: #333; margin-bottom: 5px;">Distance: Calculating...</p>
        <p id="travel-time" style="font-size: 1em; color: #333;">Time: Calculating...</p>
    </div>
</div>

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
<script src="/js/customer/overlay.js"></script>
<script src="/js/customer/service-center-directions.js"></script>

<script
    <?php
    $API_KEY = $_ENV['API_KEY'];
    echo 'src="https://maps.googleapis.com/maps/api/js?key=' . $API_KEY . '&callback=loadMap&libraries=marker&v=beta"'
    ?>
        async defer
>
</script>
</body>

</html>


