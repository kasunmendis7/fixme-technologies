<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technician Home</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="/css/technician/technician-help.css">
</head>
<body>
    <?php
    include_once 'components/sidebar.php';
    include_once 'components/header.php';
    ?>

    <div class="help-container">
        <div class="help-header">
            <h2 class="help-title">Get in touch</h2>
            <p class="help-subtitle">Want to get in touch? We'd love to hear from you. Here's how you can reach us...</p>
            <img src="assets/cusSup.png" alt="Customer Support Image">
        </div>
        <div class="help-contact-section">
            <div class="help-contact-card">
                <div class="help-icon">📞</div>
                <div class="help-title">Talk to us</div>
                <p class="help-description">Sometimes you need a little help from your friend or a Trip support rep. Don't worry...we're here for you.</p>
                <p class="help-contact-info">+71 340 0254</p>
            </div>
            <div class="help-contact-card">
                <div class="help-icon">💬</div>
                <div class="help-title">Send an inquiry</div>
                <p class="help-description">Direct any difficulties you encounter within our platform. Also, suggestions are always welcome.</p>
                <p class="help-contact-info">mailus@fixme.lk</p>
            </div>
        </div>
        <div class="help-inquiry-form">
            <?php include_once 'components/contactus.php';?>

        </div>
    </div>

    <!-- JavaScript Files -->
        <script src="/js/technician/technician-help.js"></script>
</body>
</html>