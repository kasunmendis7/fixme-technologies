<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Center Help</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/technician/technician-help.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/service-center/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>

<div class="help-container">
    <div class="help-header">
        <h2 class="help-title">Get in Touch with Us</h2>
        <div class="content-wrapper">
            <div class="text-wrapper">
                <p class="help-subtitle">We are always eager to connect and assist with any queries or concerns you
                    might have. Our dedicated team is here to provide support and ensure your experience with us is
                    seamless and satisfying. Feel free to reach out using the contact information provided below, and we
                    will respond promptly.</p>
            </div>
            <div class="image-wrapper">
                <img src="assets/cusSup.ico" alt="Customer Support Image">
            </div>
        </div>
    </div>
    <div class="help-contact-section">
        <div class="help-contact-card">
            <div class="help-icon">📞</div>
            <div class="help-title">Talk to us</div>
            <p class="help-description">If you are having trouble finding the right automobile service center, or need
                help
                with booking an appointment, just give us a call. We are here to help you to find the best service
                center
                for your vehicle.</p>
            <p class="help-contact-info">0710154855</p>
        </div>
        <div class="help-contact-card">
            <div class="help-icon">💬</div>
            <div class="help-title">Send an inquiry</div>
            <p class="help-description">Direct any difficulties you encounter within our platform. Also, suggestions are
                always welcome.</p>
            <p class="help-contact-info">fixme@gmail.com</p>
        </div>
    </div>
    <div class="help-inquiry-form">
        <?php include_once 'components/contactus.php'; ?>

    </div>
</div>
<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/customer-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>

<!-- JavaScript Files -->
<script src="/js/service-center/overlay.js"></script>
<script src="/js/service-center/service-center-home.js"></script>
</body>

</html>