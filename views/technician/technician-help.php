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
            <h2 class="help-title">Get in Touch with Us</h2>
            <div class="content-wrapper">
                <div class="text-wrapper">
                    <p class="help-subtitle">We are always eager to connect and assist with any queries or concerns you might have. Our dedicated team is here to provide support and ensure your experience with us is seamless and satisfying. Feel free to reach out using the contact information provided below, and we will respond promptly.</p>
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
                <p class="help-description">Sometimes you need a little help from your friend or a Trip support rep. Don't worry...we're here for you.</p>
                <p class="help-contact-info">0710154855</p>
            </div>
            <div class="help-contact-card">
                <div class="help-icon">💬</div>
                <div class="help-title">Send an inquiry</div>
                <p class="help-description">Direct any difficulties you encounter within our platform. Also, suggestions are always welcome.</p>
                <p class="help-contact-info">fixme@gmail.com</p>
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