<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technician Dashboard</title>
    <link rel="stylesheet" href="/css/technician/technician-dashboard.css">
    <link rel="stylesheet" href="/css/customer/customer-payment-details.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">

</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<!-- JavaScript Files -->
<script src="/js/technician/technician-home.js"></script>
<!-- ======================= Cards ================== -->
<section class="section-1">
    <div class="section-1-container">
        <div class="add-card">
            <h1>Add Card</h1>
        </div>
        <div class="visa-card-1">
            <div class="logoContainer">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        x="0px"
                        y="0px"
                        width="23"
                        height="23"
                        viewBox="0 0 48 48"
                        class="svgLogo"
                >
                    <path
                            fill="#ff9800"
                            d="M32 10A14 14 0 1 0 32 38A14 14 0 1 0 32 10Z"
                    ></path>
                    <path
                            fill="#d50000"
                            d="M16 10A14 14 0 1 0 16 38A14 14 0 1 0 16 10Z"
                    ></path>
                    <path
                            fill="#ff3d00"
                            d="M18,24c0,4.755,2.376,8.95,6,11.48c3.624-2.53,6-6.725,6-11.48s-2.376-8.95-6-11.48 C20.376,15.05,18,19.245,18,24z"
                    ></path>
                </svg>
            </div>
            <div class="number-container">
                <label class="input-label" for="cardNumber">CARD NUMBER</label>
                <input
                        class="inputstyle"
                        id="cardNumber"
                        placeholder="XXXX XXXX XXXX XXXX"
                        name="cardNumber"
                        type="text"
                />
            </div>

            <div class="name-date-cvv-container">
                <div class="name-wrapper">
                    <label class="input-label" for="holderName">CARD HOLDER</label>
                    <input
                            class="inputstyle"
                            id="holderName"
                            placeholder="NAME"
                            type="text"
                    />
                </div>

                <div class="expiry-wrapper">
                    <label class="input-label" for="expiry">VALID THRU</label>
                    <input class="inputstyle" id="expiry" placeholder="MM/YY" type="text"/>
                </div>
                <div class="cvv-wrapper">
                    <label class="input-label" for="cvv">CVV</label>
                    <input
                            class="inputstyle"
                            placeholder="***"
                            maxlength="3"
                            id="cvv"
                            type="password"
                    />
                </div>
            </div>
        </div>

    </div>
</section>
<section class="section-2">
    <div class="payment-container">
        <div class="payment-card">
            <div class="img-box">
                <img src="https://www.freepnglogos.com/uploads/visa-logo-download-png-21.png" alt="Visa">
            </div>
            <div class="number">
                <span>**** **** **** 1060</span>
            </div>
            <div class="details">
                <span>Expiry: 12/28</span>
                <span>Name: Kasun Mendis</span>
            </div>
        </div>
        <div class="payment-card">
            <div class="img-box">
                <img src="https://www.freepnglogos.com/uploads/mastercard-png/file-mastercard-logo-svg-wikimedia-commons-4.png"
                     alt="MasterCard">
            </div>
            <div class="number">
                <span>**** **** **** 1060</span>
            </div>
            <div class="details">
                <span>Expiry: 12/28</span>
                <span>Name: Kasun Mendis</span>
            </div>
        </div>
        <div class="payment-card">
            <div class="img-box">
                <img src="https://www.freepnglogos.com/uploads/discover-png-logo/credit-cards-discover-png-logo-4.png"
                     alt="Discover">
            </div>
            <div class="number">
                <span>**** **** **** 1060</span>
            </div>
            <div class="details">
                <span>Expiry: 12/28</span>
                <span>Name: Kasun Mendis</span>
            </div>
        </div>
    </div>

    <div class="payment-method">
        <h2>Payment Methods</h2>
        <div class="method">
            <h3>Debit Card/Credit Card</h3>
            <form class="payment-form">
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" placeholder="Enter card number">
                <label for="expiry-date">Expiry Date (MM/YY)</label>
                <input type="text" id="expiry-date" placeholder="MM/YY">
                <label for="cvv">CVV</label>
                <input type="password" id="cvv" placeholder="Enter CVV">
                <label for="card-name">Name on Card</label>
                <input type="text" id="card-name" placeholder="Enter name on card">
                <button type="button">Add New Card</button>
            </form>
        </div>
    </div>

</section>

<!-- Overlay for the confirmation message -->
<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/technician-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>
<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/technician/overlay.js"></script>

</body>
</html>