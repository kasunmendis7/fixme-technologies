<?php
?>


<?php

use app\core\Application;

?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/base/_reset.css">
    <link rel="stylesheet" href="/css/base/_global.css">
    <link rel="stylesheet" href="/css/service-center/market-place-navbar.css">
    <link rel="stylesheet" href="/css/home/footer.css">
    <link rel="stylesheet" href="/css/home/home.css">
    <link rel="stylesheet" href="/css/service-center/marketplace.css">
    <link rel="stylesheet" href="/css/service-center/market-place-product-view.css">
    <link rel="stylesheet" href="/css/service-center/checkout.css">
    <!-- <link rel="stylesheet" href="/css/service-center/marketplace-navbar.css"> -->
    <script src="/js/home/main.js"></script>
    <script src="/js/technician/main.js"></script>
    <!-- <script src="/js/service-center/marketplace-navbar.js"></script> -->
    <script src="/js/service-center/marketplace-home.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script> -->
    <title>Market Place</title>
</head>

<body>


    <nav class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img class="logo-img" src="/assets/shopping-cart_market-place.png">
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 link-secondary">Home</a></li>
                <li><a href="/service-centre-landing" class="nav-link px-2">Service Centre</a></li>
                <li><a href="/about-us" class="nav-link px-2">About</a></li>
                <li class="position-relative">
                    <a href="/view-cart" class="nav-link px-2" style="position: relative; display: inline-block;">
                        <ion-icon name="cart-outline" style="font-size: 24px;  color: #fff;"></ion-icon>
                        <span id="cart-count" class="position-absolute badge rounded-pill bg-danger" style="
                        display: none;
                        top: -5px;
                        right: -10px;
                        font-size: 0.65rem;
                        background-color: #dc3545;
                        color: white;
                        padding: 3px 6px;
                        border-radius: 50%;
                        box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
                        min-width: 18px;
                        text-align: center;
                        font-weight: bold;
                        position: absolute;
                    ">
                            0
                        </span>
                    </a>
                </li>
            </ul>

            <div class="dropdown" style="margin-right: 15px;">
                <?php
                $userId = Application::$app->session->get('customer');

                if ($userId) {
                    $customerClass = Application::$app->customerClass;
                    $customerInstance = new $customerClass();
                    $customer = $customerInstance->findOne(['cus_id' => $userId]);
                    $username = $customer->fname;
                    $userProfile = $customer->profile_picture;
                    ?>
                    <div class="dropdown-toggle" style="display: flex; align-items: center; gap: 10px; cursor: pointer;"
                        onclick="toggleDropdown()">
                        <?php
                        if (!empty($userProfile)) {
                            echo '<img src="/assets/uploads/' . htmlspecialchars($userProfile) . '" alt="Profile Picture" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">';
                        } else {
                            echo '<img src="/assets/default-profile.svg" alt="Default Profile Picture" style="width: 40px; height: 40px; background-color: white; border-radius: 50%; object-fit: cover;">';
                        }
                        if (!empty($username)) {
                            echo '<span style="font-size: 16px; font-weight: 500; color: #fff;">' . htmlspecialchars($username) . '</span>';
                        }
                        ?>
                    </div>
                    <div id="profileDropdown" class="dropdown-menu"
                        style="display: none; position: absolute; right: 0; background-color: white; min-width: 180px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1; border-radius: 4px; margin-top: 5px;">
                        <a href="/customer-profile"
                            style="color: black; padding: 12px 16px; text-decoration: none; display: block; font-size: 14px;">
                            <ion-icon name="person-outline" style="vertical-align: middle; margin-right: 5px;"></ion-icon>
                            My Profile
                        </a>
                        <a href="/customer-orders"
                            style="color: black; padding: 12px 16px; text-decoration: none; display: block; font-size: 14px;">
                            <ion-icon name="bag-outline" style="vertical-align: middle; margin-right: 5px;"></ion-icon> My
                            Orders
                        </a>
                        <div style="height: 1px; background-color: #e0e0e0; margin: 5px 0;"></div>
                        <a href="/customer-logout"
                            style="color: #dc3545; padding: 12px 16px; text-decoration: none; display: block; font-size: 14px;">
                            <ion-icon name="log-out-outline" style="vertical-align: middle; margin-right: 5px;"></ion-icon>
                            Logout
                        </a>
                    </div>
                    <?php
                } else {
                    echo '<button onclick="window.location.href=\'/customer-login\'" style="padding: 8px 16px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">Login</button>';
                }
                ?>
            </div>
        </header>
    </nav>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            if (dropdown.style.display === 'none' || dropdown.style.display === '') {
                dropdown.style.display = 'block';
            } else {
                dropdown.style.display = 'none';
            }
        }

        // Close the dropdown if user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.dropdown-toggle') && !event.target.matches('.dropdown-toggle *')) {
                const dropdown = document.getElementById('profileDropdown');
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            }
        }
    </script>



    <section>
        <div class="flash-message">
            <?php if (Application::$app->session->getFlash('success')): ?>
                <div class="alert alert-success">
                    <?php echo Application::$app->session->getFlash('success') ?>
                </div>
                <div style="position: fixed; bottom: 25%; right: 8%; z-index: 999;">
                    <button type="submit" id="payhere-button"
                        style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer;">
                        Pay Now
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if (Application::$app->session->getFlash('success')): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const submitBtn = document.getElementById("submit-btn");
                if (submitBtn) {
                    submitBtn.style.display = "none";
                }
            });
        </script>
    <?php endif; ?>



    <header>
        <h3>
            <center>Checkout</center>
        </h3>
    </header>

    <main>

        <section class="checkout-form">
            <form action="/checkout-save" id="myForm" method="post">
                <h6>Contact information</h6>
                <div class="form-control">
                    <label for="checkout-email">E-mail</label>
                    <div>
                        <span class="fa fa-envelope"></span>
                        <input type="email" id="checkout-email" name="checkout-email" placeholder="Enter your email...">
                    </div>
                </div>
                <div class="form-control">
                    <label for="checkout-phone">Phone</label>
                    <div>
                        <span class="fa fa-phone"></span>
                        <input type="tel" name="checkout-phone" id="checkout-phone" placeholder="Enter you phone...">
                    </div>
                </div>
                <br>
                <h6>Shipping address</h6>
                <div class="form-control">
                    <label for="checkout-name">Full name</label>
                    <div>
                        <span class="fa fa-user-circle"></span>
                        <input type="text" id="checkout-name" name="checkout-name" placeholder="Enter you name...">
                    </div>
                </div>
                <div class="form-control">
                    <label for="checkout-address">Address</label>
                    <div>
                        <span class="fa fa-home"></span>
                        <input type="text" name="checkout-address" id="checkout-address" placeholder="Your address...">
                    </div>
                </div>
                <div class="form-control">
                    <label for="checkout-city">City</label>
                    <div>
                        <span class="fa fa-building"></span>
                        <input type="text" name="checkout-city" id="checkout-city" placeholder="Your city...">
                    </div>
                </div>
                <div class="form-group">
                    <!-- <div class="form-control">
                <label for="checkout-country">Country</label>
                <div>
                    <span class="fa fa-globe"></span>
                    <input type="text" name="checkout-country" id="checkout-country" placeholder="Your country..."
                        list="country-list">
                    <datalist id="country-list">
                        <option value="India"></option>
                        <option value="USA"></option>
                        <option value="Russia"></option>
                        <option value="Japan"></option>
                        <option value="Egypt"></option>
                    </datalist>
                </div>
            </div> -->
                    <div class="form-control">
                        <label for="checkout-postal">Postal code</label>
                        <div>
                            <span class="fa fa-archive"></span>
                            <input type="numeric" name="checkout-postal" id="checkout-postal"
                                placeholder="Your postal code...">
                        </div>
                    </div>
                </div>
                <!-- <div class="form-control checkbox-control">
            <input type="checkbox" name="checkout-checkbox" id="checkout-checkbox">
            <label for="checkout-checkbox">Save this information for next time</label>
        </div> -->
                <div class="form-control-btn" id="form-control-btn">
                    <button type="submit" id="submit-btn" onclick="hideSubmitButton()">Submit</button>
                </div>
            </form>
        </section>

        <section class="checkout-details">
            <div class="checkout-details-inner">
                <div class="checkout-lists">
                    <?php
                    $total = 0;
                    $shipping = 200.00;
                    foreach ($cartItems as $item):
                        $price = $item['discount_price'] ?? $item['price'];
                        $subtotal = $price * $item['quantity'];
                        $total += $subtotal;
                        ?>
                        <div class="card">
                            <div class="card-image">
                                <img src="/assets/uploads/<?= $item['media'] ?>" alt="">
                            </div>
                            <div class="card-details">
                                <div class="card-name" style="font-size: 1.4rem;">
                                    <?= htmlspecialchars($item['description']) ?>
                                </div>
                                <div class="card-price" style="font-size: 1.2rem;">
                                    Rs. <?= number_format($price, 2) ?>
                                    <!-- <?php if ($item['price']): ?>
                                        <span>Rs. <?= number_format($item['price'], 2) ?></span>
                                    <?php endif; ?> -->
                                </div>
                                <div class="card-wheel">
                                    <!-- <button>-</button> -->
                                    <span style="align-items: center; margin-left: 50%;"><?= $item['quantity'] ?></span>
                                    <!-- <button>+</button> -->
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="checkout-shipping">
                    <h6>Shipping</h6>
                    <p style="font-size: 1rem;">Rs. <?= number_format($shipping, 2) ?></p>
                </div>
                <div class="checkout-total">
                    <h6>Total</h6>
                    <p style="font-size: 1rem;">Rs. <?= number_format($total + $shipping, 2) ?></p>
                </div>
            </div>
        </section>


    </main>

    <!-- create a pay button -->



    <div class="container-f">
        <footer class="py-5">
            <div class="row">
                <div class="col-6 col-md-2 mb-3">
                    <h3 class="ml-3">FIXME</h3>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <h5>Company</h5>
                    <ul class="nav-f flex-column">
                        <li class="nav-item-f mb-2"><a href="#" class="nav-link-f p-0 text-body-secondary">About Us</a>
                        </li>
                        <li class="nav-item-f mb-2"><a href="#" class="nav-link-f p-0 text-body-secondary">Our
                                Offerings</a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-md-2 mb-3">
                    <h5>Products</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item-f mb-2"><a href="#" class="nav-link-f p-0 text-body-secondary">Nearby
                                Technicians</a></li>
                        <li class="nav-item-f mb-2"><a href="#" class="nav-link-f p-0 text-body-secondary">Service
                                Centers</a></li>
                        <li class="nav-item-f mb-2"><a href="#" class="nav-link-f p-0 text-body-secondary">Service
                                Center
                                Marketplace</a></li>
                    </ul>
                </div>

                <div class="col-6 col-md-2 mb-3">
                    <h5>Safety Measures</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item-f mb-2"><a href="#" class="nav-link-f p-0 text-body-secondary">Safety</a>
                        </li>
                        <li class="nav-item-f mb-2"><a href="#" class="nav-link-f p-0 text-body-secondary">Diversity and
                                Inclusion</a></li>
                    </ul>
                </div>

            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 mx-4 border-top">
                <p>© 2024 Fixme Technologies Inc.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-body-emphasis" href="#">
                            <svg class="bi" width="24" height="24">
                                <path
                                    d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.284-.009-.425A6.683 6.683 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518A3.301 3.301 0 0 0 15.555 2a6.533 6.533 0 0 1-2.084.797 3.301 3.301 0 0 0-5.617 3.005A9.355 9.355 0 0 1 1.114 2.1a3.3 3.3 0 0 0 1.019 4.396A3.267 3.267 0 0 1 .64 6.575v.034a3.301 3.301 0 0 0 2.644 3.234 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.621-.059 3.305 3.305 0 0 0 3.067 2.281A6.588 6.588 0 0 1 0 13.027 9.286 9.286 0 0 0 5.031 15z" />
                                <use xlink:href="#twitter"></use>
                            </svg>
                        </a></li>
                    <li class="ms-3"><a class="link-body-emphasis" href="#">
                            <svg class="bi" width="24" height="24">
                                <path
                                    d="M8 0C5.79 0 5.555.01 4.69.047a6.153 6.153 0 0 0-2.292.431 4.383 4.383 0 0 0-1.633 1.064A4.394 4.394 0 0 0 .048 4.69 6.154 6.154 0 0 0 0 6.977C0 7.445.002 7.805.005 8.128L.02 9.81v1.154c.003.352.006.729.006 1.104 0 .375-.003.752-.006 1.104v1.154c-.003.326-.005.687-.005 1.155 0 .642.027 1.192.125 1.684.099.492.264.939.518 1.33.22.333.514.616.87.857.33.226.706.41 1.12.556.466.166 1.065.239 1.747.263C5.805 16 6.287 16 8 16c1.713 0 2.195-.002 2.74-.014.682-.024 1.28-.097 1.746-.263a4.432 4.432 0 0 0 1.12-.556c.357-.241.65-.524.87-.857.253-.391.419-.838.518-1.33.098-.492.125-1.042.125-1.684 0-.469-.002-.83-.005-1.155v-1.154c-.003-.352-.006-.729-.006-1.104 0-.375.003-.752.006-1.104V9.81l.015-1.683c.003-.326.005-.687.005-1.155 0-.642-.027-1.192-.125-1.684a4.406 4.406 0 0 0-.518-1.33c-.22-.333-.514-.616-.87-.857a4.438 4.438 0 0 0-1.12-.556 6.163 6.163 0 0 0-1.746-.263C10.195.003 9.713.001 8 .001zm0 1.557c1.65 0 1.914.007 2.586.036.589.026 1.021.102 1.344.231.408.17.706.375.956.624.249.249.453.548.624.956.129.323.205.755.231 1.344.03.672.037.936.037 2.586 0 1.65-.007 1.914-.036 2.586-.026.589-.102 1.021-.231 1.344a2.764 2.764 0 0 1-.624.956 2.784 2.784 0 0 1-.956.624c-.323.129-.755.205-1.344.231-.672.03-.936.037-2.586.037-1.65 0-1.914-.007-2.586-.036-.589-.026-1.021-.102-1.344-.231a2.77 2.77 0 0 1-.956-.624 2.786 2.786 0 0 1-.624-.956c-.129-.323-.205-.755-.231-1.344-.03-.672-.037-.936-.037-2.586 0-1.65.007-1.914.036-2.586.026-.589.102-1.021.231-1.344.17-.408.375-.706.624-.956.249-.249.548-.453.956-.624.323-.129.755-.205 1.344-.231.672-.03.936-.037 2.586-.037zM8 3.292a4.706 4.706 0 1 0 0 9.411 4.706 4.706 0 0 0 0-9.411zm0 1.55a3.156 3.156 0 1 1 0 6.311 3.156 3.156 0 0 1 0-6.311zm4.566-.855a1.088 1.088 0 1 0 0 2.176 1.088 1.088 0 0 0 0-2.176z" />
                                <use xlink:href="#instagram"></use>
                            </svg>
                        </a></li>
                    <li class="ms-3"><a class="link-body-emphasis" href="#">
                            <svg class="bi" width="24" height="24">
                                <path
                                    d="M8 0C3.582 0 0 3.582 0 8c0 4.07 3.065 7.428 7.032 7.931V10.14H5.037V8h1.995V6.392c0-1.973 1.21-3.05 2.963-3.05.84 0 1.562.063 1.77.09v2.053h-1.215c-.952 0-1.137.451-1.137 1.113V8h2.273l-.296 2.14H9.413v5.79C13.35 15.428 16 12.07 16 8c0-4.418-3.582-8-8-8z" />
                                <use xlink:href="#facebook"></use>
                            </svg>
                        </a></li>
                </ul>
            </div>
        </footer>
    </div>


    <!-- Include PayHere SDK -->
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <!-- JS for handling PayHere payment -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const payButton = document.getElementById('payhere-button');

            if (!payButton) {
                console.error("PayHere button not found!");
                return;
            }

            payButton.addEventListener('click', function () {
                fetch('/marketplace-payment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Failed to fetch payment data");
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Payment Data Received:", data);

                        payhere.onCompleted = function onCompleted(orderId) {
                            alert("Payment completed! OrderID: " + orderId);
                            // You can redirect or show a success page here
                            window.location.href = `/get-invoice/${orderId}`;
                            // window.location.href = `/customer-order-details/${orderId}`;

                        };

                        payhere.onDismissed = function onDismissed() {
                            alert("Payment dismissed.");
                        };

                        payhere.onError = function onError(error) {
                            console.error("PayHere Error:", error);
                            alert("Error: " + error);
                        };

                        var payment = {
                            "sandbox": true,
                            "merchant_id": "1229154",    // Replace your Merchant ID
                            "return_url": "http://localhost:8080/",     // Important
                            "cancel_url": "http://localhost:8080/",     // Important
                            "notify_url": "https://25b2-2402-4000-1255-c5eb-44-8c77-86b0-9c94.ngrok-free.app/marketplace-payment-response",
                            "order_id": data.order_id,
                            "items": data.items,
                            "amount": data.amount + 200,
                            "currency": "LKR",
                            "hash": data.hash, // *Replace with generated hash retrieved from backend
                            "first_name": data.full_name,
                            "last_name": "",
                            "email": data.email,
                            "phone": data.phone,
                            "address": data.address,
                            "city": data.city,
                            "country": "Sri Lanka",
                            "delivery_address": data.address,
                            "delivery_city": data.city,
                            "delivery_country": "Sri Lanka",
                            "custom_1": data.customer_1,
                            "custom_2": ""
                        }


                        payhere.startPayment(payment);
                    })
                    .catch(error => {
                        console.error("Error initiating payment:", error);
                        alert("Failed to initiate payment.");
                    });
            });
        });
    </script>

    <!-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("myForm");
            const submitBtn = document.getElementById("submit-btn");

            form.addEventListener("submit", function () {
                // Optional: disable button immediately to prevent double-clicks
                submitBtn.disabled = true;
                submitBtn.innerText = "Submitting...";
            });
        });
    </script> -->
</body>