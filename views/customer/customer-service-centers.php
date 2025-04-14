<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Find service center</title>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/customer/customer-service-centers.css">
</head>

<body>
<?php

use app\core\Application;
use app\models\Customer;

include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<div class="search-container">
    <h2 class="search-title">Search Service center</h2>
    <div class="search-options">
        <button class="option-button active">Service center Only</button>
    </div>

    <form class="search-form" onsubmit="event.preventDefault();">
        <div class="input-group">
            <label><span><ion-icon name="person"></ion-icon></span> Service center Name</label>
            <input type="text" id="service-center-search" placeholder="Amila Sugathsiri">
        </div>
    </form>
</div>

<div class="cust-tech-container">
    <div class="tech-container row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="technicians-list">
        <?php
        $customer = new Customer();
        $serviceCenters = $customer->getAllServiceCentersSortedByDistance();
        if ($serviceCenters['status'] === 'success' && empty($serviceCenters['data'])) {
            echo '<h2>No Service Centers found !</h2>';
        } elseif ($serviceCenters['status'] === 'success' && !empty($serviceCenters['data'])) {
            foreach ($serviceCenters['data'] as $serviceCenter) {
                echo '<div class="col service-center-card" data-name="' . strtolower($serviceCenter['name']) . '">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">' . $serviceCenter['name'] . '</h5>
                            <h6 class="distance">' . $serviceCenter['distance'] . ' km Away</h6>
                            <h6 class="distance">' . round($serviceCenter['duration']) . ' mins Away</h6>
                            <h5 class="rating">Rating: 
                            <span> 4.5</span>
                            </h5>
                            <h5 class="service-category">Motor Mechanic</h5>
                            <ion-icon name="star" style="color: Gold"></ion-icon>
                            <ion-icon name="star" style="color: Gold"></ion-icon>
                            <p class="card-text">12 years expericenced motor mechanic worked for BMW.</p>
                            <button type="button" class="btn btn-primary" onclick="viewProfile(' . $serviceCenter['ser_cen_id'] . ')">View Profile</button>
                        </div>
                    </div>
                </div>';
            }
        } elseif ($serviceCenters['status'] === 'error') {
            echo '<h2>An Unexpected error occured while fetching Service Centers</h2>';
        }
        ?>
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
<script src="/js/customer/customer-service-centers.js"></script>
<script src="/js/customer/customer-home.js"></script>
<script src="/js/customer/overlay.js"></script>
</body>

</html>
