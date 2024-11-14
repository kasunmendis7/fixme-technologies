<?php

use app\core\Application;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/service-center/marketplace-home.css">
    <link rel="stylesheet" href="/css/technician/technician-dashboard.css">


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="/js/service-center/marketplace-home.js"></script>
    <title>Fixme Home</title>
</head>

<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<section id="sellers">
    <div class="seller-container">

        <div class="best-seller">
            <div class="best-p1">
                <img src="https://i.postimg.cc/8CmBZH5N/shoes.webp" alt="img">
                <div class="best-p1-txt">
                    <div class="name-of-p">
                        <p>PS England Shoes</p>
                    </div>
                    <div class="rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>
                    </div>
                    <div class="price">
                        &dollar;37.24
                        <div class="colors">
                            <i class='bx bxs-circle red'></i>
                            <i class='bx bxs-circle blue'></i>
                            <i class='bx bxs-circle white'></i>
                        </div>
                    </div>
                    <div class="buy-now">
                        <button><a href="#">Order</a></button>
                    </div>
                    <!-- <div class="add-cart">
                        <button>Add To Cart</button>
                    </div> -->
                </div>
            </div>


        </div>
    </div>

</section>
<section id="contact">
    <div class="contact container">
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.121169986175!2d73.90618951442687!3d18.568575172551647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c131ed5b54a7%3A0xad718b8b2c93d36d!2sSky%20Vista!5e0!3m2!1sen!2sin!4v1654257749399!5m2!1sen!2sin"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <form action="https://formspree.io/f/xzbowpjq" method="POST">
            <div class="form">
                <div class="form-txt">
                    <h4>INFORMATION</h4>
                    <h1>Contact Us</h1>
                    <span>As you might expect of a company that began as a high-end interiors contractor, we pay strict
                          attention.</span>

                </div>
                <div class="form-details">
                    <input type="text" name="name" id="name" placeholder="Name" required>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <textarea name="message" id="message" cols="52" rows="7" placeholder="Message" required></textarea>
                    <button>SEND MESSAGE</button>
                </div>
            </div>
        </form>
    </div>
</section>

</body>
