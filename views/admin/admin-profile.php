<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Settings</title>
    <link rel="stylesheet" href="/css/admin/admin-profile.css">
    <link rel="stylesheet" href="/css/admin/admin-settings.css">
    <link rel="stylesheet" href="/css/admin/overlay.css">
</head>

<body>
<?php

use app\core\Application;

include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<div class="cust-profile ">
    <div class="wrapper">
        <?php if (Application::$app->session->getFlash('update-success')): ?>
            <div class="alert alert-success">
                <?php echo Application::$app->session->getFlash('update-success') ?>
            </div>
        <?php endif; ?>
    </div>

    <form method="post" id="profileForm" action="/update-admin-profile">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="<?php echo Application::$app->admin->{'profile_picture'} ?>" alt="user profile picture"/>
                    <button class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file"/>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h3>
                        <ion-icon name="finger-print-outline"></ion-icon>
                        <?php $usename = strtoupper(Application::$app->admin->{'fname'}) . ' ' . strtoupper(Application::$app->admin->{'lname'});
                        echo $usename;
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
                                        <label>First Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo strtoupper(Application::$app->admin->{'fname'}) ?></p>
                                        <input type="text" name="fname" id="firstNameInput"
                                               value="<?php echo Application::$app->admin->{'fname'} ?>"
                                               class="edit-input" style="display:none;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ion-icon name="person-circle-outline"></ion-icon>
                                        <label>Last Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo strtoupper(Application::$app->admin->{'lname'}) ?></p>
                                        <input type="text" name="lname" id="lastNameInput"
                                               value="<?php echo Application::$app->admin->{'lname'} ?>"
                                               class="edit-input" style="display:none;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ion-icon name="mail-outline"></ion-icon>
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo Application::$app->admin->{'email'} ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ion-icon name="call-outline"></ion-icon>
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo Application::$app->admin->{'phone_no'} ?></p>
                                        <input type="tel" name="phone_no" id="phoneNoInput"
                                               value="<?php echo Application::$app->admin->{'phone_no'} ?>"
                                               class="edit-input" style="display:none;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ion-icon name="location-outline"></ion-icon>
                                        <label>Address</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo Application::$app->admin->{'address'} ?></p>
                                        <input type="text" name="address" id="addressInput"
                                               value="<?php echo Application::$app->admin->{'address'} ?>"
                                               class="edit-input" style="display:none;">
                                    </div>
                                </div>
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

    </form>
</div>


<!-- Overlay for the confirmation message -->
<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/admin-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>
<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/admin/admin-profile.js"></script>
<script src="/js/admin/admin-home.js"></script>
<script src="/js/admin/overlay.js"></script>
</body>

</html>