<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service center Profile</title>
    <!-- <link rel="stylesheet" href="/css/customer/customer-profile.css"> -->
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/service-center/service-center-profile.css">
    <link rel="stylesheet" href="/css/service-center/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>

<?php

use app\core\Application;

include_once 'components/sidebar.php';
include_once 'components/header.php';

?>

</body>

<div class="cust-profile">
    <div class="wrapper">
        <?php if (Application::$app->session->getFlash('update-success')): ?>
            <div class="alert alert-success">
                <?php echo Application::$app->session->getFlash('update-success') ?>
            </div>
        <?php endif; ?>
    </div>

    <form method="post" id="profileForm" action="/update-service-centre-profile">
        <div class="row">
            <div class="col-md-6">
                <div class="profile-head">
                    <h3>
                        <ion-icon name="finger-print-outline"></ion-icon>
                        <?php $serviceCenter = strtoupper(Application::$app->serviceCenter->{'name'});
                        echo $serviceCenter;
                        ?>
                    </h3>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ion-icon name="person-circle-outline"></ion-icon>
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo strtoupper(Application::$app->serviceCenter->{'name'}) ?></p>
                                        <input type="text" name="name" id="firstNameInput"
                                               value="<?php echo Application::$app->serviceCenter->{'name'} ?>"
                                               class="edit-input" style="display:none;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <ion-icon name="mail-outline"></ion-icon>
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo Application::$app->serviceCenter->{'email'} ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ion-icon name="call-outline"></ion-icon>
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo Application::$app->serviceCenter->{'phone_no'} ?></p>
                                        <input type="tel" name="phone_no" id="phoneNoInput"
                                               value="<?php echo Application::$app->serviceCenter->{'phone_no'} ?>"
                                               class="edit-input" style="display:none;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ion-icon name="location-outline"></ion-icon>
                                        <label>Address</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo Application::$app->serviceCenter->{'address'} ?></p>
                                        <input type="text" name="address" id="addressInput"
                                               value="<?php echo Application::$app->serviceCenter->{'address'} ?>"
                                               class="edit-input" style="display:none;">
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-6">
                                        <ion-icon name="cog-outline"></ion-icon>
                                        <label>Services</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo Application::$app->serviceCenter->{'service_category'} ?></p>
                                        <input type="text" name="service_category" id="addressInput"
                                               value="<?php echo Application::$app->serviceCenter->{'service_category'} ?>"
                                               class="edit-input" style="display:none;">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" class="profile-edit-btn" id="editProfileBtn" name="btnAddMore">Edit Profile
                </button>
                <button type="submit" class="profile-save-btn" id="saveProfileBtn" style="display:none;">Save Changes
                </button>
            </div>
        </div>
</div>
</form>

</div>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/service-center/service-center-profile.js"></script>
<script src="/js/service-center/service-center-home.js"></script>
<script src="/js/service-center/overlay.js"></script>
</html>