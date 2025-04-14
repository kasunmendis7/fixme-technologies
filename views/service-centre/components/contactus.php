<?php ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="/css/service-center/contactus.css">
</head>

<body>
<div class="contact-us-container">
    <div class="contact-us-left">
        <h2 class="contact-us-heading">Contact Us</h2>
        <p class="contact-us-text">We are here for you! How can we help you?</p>
        <form method="post" action="/service-center-help/send-email">
            <div class="contact-us-input-box">
                <label for="contact-us-name">Name: </label>
                <input type="text" name="contact-us-name" id="contact-us-name" class="contact-us-name"
                       placeholder="Enter your name">
            </div>
            <div class="contact-us-input-box">
                <label for="contact-us-email">Email: </label>
                <input type="text" name="contact-us-email" id="contact-us-email" class="contact-us-email"
                       placeholder="Enter your email address">
            </div>
            <div class="contact-us-input-box">
                <label for="contact-us-message">Message: </label>
                <textarea name="contact-us-message" class="contact-us-message"
                          placeholder="Enter your message..."></textarea>
            </div>
            <button class="contact-us-btn">Submit</button>
        </form>
    </div>
    <div class="contact-us-right">
        <div class="contact-us-illustration">
            <img src="/assets/contact-us.ico" alt="Contact Us Illustration">
        </div>
    </div>
</body>

</html>
