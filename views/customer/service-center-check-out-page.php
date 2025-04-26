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
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/service-center/checkout.css">

    <script src="/js/home/main.js"></script>
    <script src="/js/technician/main.js"></script>
    <script src="/js/service-center/marketplace-home.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script> -->
    <title>Market Place</title>
</head>

<body>

    <?php
    include_once 'components/sidebar.php';
    include_once 'components/header.php';
    ?>

    <section>
        <div class="flash-message">
            <?php if (Application::$app->session->getFlash('success')): ?>
                <div class="alert alert-success">
                    <?php echo Application::$app->session->getFlash('success') ?>
                </div>
                <div style="position: fixed; bottom: 2%; right: 6%; z-index: 999;">
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
            <form action="/checkout-save-customer" id="myForm" method="post">
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
                                <div class="card-name" style="font-size: 1rem;">
                                    <?= htmlspecialchars($item['description']) ?>
                                </div>
                                <div class="card-price" style="font-size: 0.9rem;">
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
                            window.location.href = `/get-invoice/${orderId}`;
                            // You can redirect or show a success page here
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
                            "notify_url": "https://e591-2402-4000-1324-56c6-c619-5239-8a0c-84d2.ngrok-free.app/marketplace-payment-response",
                            "order_id": data.order_id,
                            "items": data.items,
                            "amount": data.amount,
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

                        console.log("payment detials, ", payment);

                        // Start the payment
                        // payhere.startPayment({
                        //     sandbox: true, // Change to false for live
                        //     merchant_id: data.merchant_id,
                        //     return_url: "http://localhost:8080/",
                        //     cancel_url: "http://localhost:8080/",
                        //     notify_url: "https://5a8b-2a09-bac5-485f-1d05-00-2e4-9a.ngrok-free.app/payhere-payment-response", // Update if you use IPN
                        //     order_id: data.order_id,
                        //     items: data.items,
                        //     amount: data.amount + 200,
                        //     currency: data.currency,
                        //     hash: data.hash,
                        //     first_name: data.full_name,
                        //     last_name: "", // Optional
                        //     email: data.email,
                        //     phone: data.phone,
                        //     address: data.address,
                        //     city: data.city,
                        //     country: data.country,
                        //     delivery_address: data.address,
                        //     delivery_city: data.city,
                        //     delivery_country: "Sri Lanka",
                        //     custom_1: "",
                        //     custom_2: ""
                        // });

                        payhere.startPayment(payment);
                    })
                    .catch(error => {
                        console.error("Error initiating payment:", error);
                        alert("Failed to initiate payment.");
                    });
            });
        });
    </script>

</body>