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
        <?php endif; ?>
    </div>
</section>

<?php

include_once 'components/check-out.php';

?>

<!-- create a pay button -->
<button type="submit" id="payhere-button">PayHere Pay</button>

<!-- <script src="/js/service-center/marketplace-payment.js"></script> -->
<!-- <script>    include_once '<components>check-out.php';

async function paymenteGateway() {
let baseUrl = window.location.origin;
let apiUrl = `${baseUrl}/marketplace-payment`;

try {

    const response = await fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        }
    });

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }

    const paymentDetails = await response.json();

    console.log("paymentDetails", paymentDetails);

    if(paymentDetails.error) {
        alert(paymentDetails.error);
        return;
    }

    payhere.onCompleted = (orderId) => {
        clgassic.log("Payment completed. OrderID:" + orderId);

        window.location.href = '/market-place-home';
    }

    payhere.onDismissed = () => {
        console.log("Payment dismissed");
    }

    payhere.onError = (error) => {
        console.log("Error:" + error);
    }

    const payment = {
        sandbox: true,
        merchant_id: "1230101",
        order_id: paymentDetails.order_id,
        items: paymentDetails.items,
        amount: paymentDetails.amount,
        currency: paymentDetails.currency,
        full_name: paymentDetails.full_name,
        email: paymentDetails.email,
        phone: paymentDetails.phone,
        address: paymentDetails.address,
        city: paymentDetails.city,
        country: paymentDetails.country,
        return_url: "http://localhost:8080/",
        cancel_url: "http://localhost:8080/",
        notify_url: "https://5a8b-2a09-bac5-485f-1d05-00-2e4-9a.ngrok-free.app/payhere-payment-response",
        delivery_address: "",
        delivery_city: "",
        delivery_country: "",
        custom_1: "",
        custom_2: ""
    }

    // Initiate payment
    document.getElementById('payhere-payment').onclick = function(e) {
        e.preventDefault();
        payhere.startPayment(payment);
    }

} catch (error) {

    console.error("Error processing payment:", error);
    alert("An error occurred while processing the payment. Please try again.");

}

}
</script> -->

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
                        "notify_url": "https://3bc8-112-134-150-236.ngrok-free.app/marketplace-payment-response",
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