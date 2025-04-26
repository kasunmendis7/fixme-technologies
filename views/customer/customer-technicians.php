<?php

use app\core\Application;
use app\models\Customer;
use app\models\TechnicianReview;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technicians</title>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/customer/customer-technicians.css">
</head>

<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<div class="search-container">
    <h2 class="search-title">Search Technicians</h2>
    <div class="search-options">
        <button class="option-button active">Technician Only</button>
    </div>

    <form class="search-form" onsubmit="event.preventDefault();">
        <div class="input-group">
            <label><span><ion-icon name="person"></ion-icon></span> Technician Name</label>
            <input type="text" id="technician-search" placeholder="Amila Sugathsiri" oninput="filterTechnicians()">
        </div>
    </form>
</div>

<div class="cust-tech-container">
    <div class="tech-container row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="technicians-list">
        <?php
        $customer = new Customer();
        $technicians = $customer->getAllTechniciansSortedByDistance();

        if ($technicians['status'] === 'success' && empty($technicians['data'])) {
            echo '<h2>No Technicians found!</h2>';
        } elseif ($technicians['status'] === 'success' && !empty($technicians['data'])) {
            foreach ($technicians['data'] as $technician) {
                $techReviewModel = new TechnicianReview();
                $averageRatings = $techReviewModel->getAverageRatings($technician['tech_id']);

                $starsHtml = '';
                $roundedRating = round($averageRatings);
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $roundedRating) {
                        $starsHtml .= '<ion-icon name="star" style="color: Gold"></ion-icon>';
                    } else {
                        $starsHtml .= '<ion-icon name="star-outline"></ion-icon>';
                    }
                }
                echo '<div class="col technician-card" data-name="' . strtolower($technician['fname']) . '' . strtolower($technician['lname']) . '">
            <div class="card">
                <img src="' . $technician['profile_picture'] . '" class="card-img-top" alt="Profile picture">
                <div class="card-body">
                    <h5 class="card-title">' . $technician['fname'] . ' ' . $technician['lname'] . '</h5>
                    <h6 class="distance">' . $technician['distance'] . ' km Away</h6>
                    <h6 class="distance">' . round($technician['duration']) . ' mins Away</h6>
                    <h5 class="rating">Rating: 
                    <span>' . number_format($averageRatings, 1) . '</span>
                    </h5>
                    <h5 class="service-category">Technician</h5>
                    ' . $starsHtml . '
                    <button type="button" class="btn btn-primary" onclick="viewProfile(' . $technician['tech_id'] . ')">View Profile</button>
                </div>
            </div>
        </div>';
            }
        } elseif ($technicians['status'] === 'error') {
            echo '<h2>An Unexpected error occurred while fetching Technicians</h2>';
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
<script src="/js/customer/customer-technicians.js"></script>
<script src="/js/customer/customer-home.js"></script>
<script src="/js/customer/overlay.js"></script>
</body>

</html>