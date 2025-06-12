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

        if (paymentDetails.error) {
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
            notify_url: "https://cedf-194-59-6-81.ngrok-free.app /payhere-payment-response",
            delivery_address: "",
            delivery_city: "",
            delivery_country: "",
            custom_1: "",
            custom_2: ""
        }

        // Initiate payment
        document.getElementById('payhere-payment').onclick = function (e) {
            e.preventDefault();
            payhere.startPayment(payment);
        }

    } catch (error) {

        console.error("Error processing payment:", error);
        alert("An error occurred while processing the payment. Please try again.");

    }

}