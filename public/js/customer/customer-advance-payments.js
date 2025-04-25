function payNow(pin) {
    alert(`Pay Now to order no ${pin}`);
}

async function rejectPayment(reqId) {
    const response = await fetch(`http://localhost:8080/reject-advance-payment/${reqId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    });
    window.location.href = '/customer-advance-payments';
}

async function paymentGateWay(cusId, techId) {
    // Get the base URL dynamically
    let baseUrl = window.location.origin;
    console.log(baseUrl);

    // Construct the endpoint URL
    let apiUrl = `${baseUrl}/payhere-payment`;

    payload = {
        cus_id: cusId,
        tech_id: techId,
    };

    try {
        // Make the GET request using fetch
        const response = await fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        // Extract response as text and alert it
        const responseText = await response.text();
        //   alert(responseText);

        // Parse the response JSON
        const object = JSON.parse(responseText);

        // Set up payment event handlers
        payhere.onCompleted = (orderId) => {
            console.log("Payment completed. OrderID:" + orderId);
            // Show a success message
            //alert("Payment successful!");
            //updatePaymentStatus(orderId);
            // Reload the page to update the payment status display
            window.location.reload();
        };

        payhere.onDismissed = () => {
            // Prompt user to pay again or show an error page
            console.log("Payment dismissed");
        };

        payhere.onError = (error) => {
            // Show an error page
            console.log("Error:" + error);
        };

        // Set up payment variables
        const payment = {
            sandbox: true,
            merchant_id: "1230101",
            return_url: "http://localhost:8080/customer-active-contracts",
            cancel_url: "http://localhost:8080/customer-dashboard",
            notify_url: "https://5019-2a09-bac1-4320-00-279-6.ngrok-free.app/payhere-payment-response", // This needs to be updated accordingly
            order_id: object["order_id"],
            items: object["items"],
            amount: object["amount"],
            currency: object["currency"],
            hash: object["hash"],
            first_name: object["first_name"],
            last_name: object["last_name"],
            email: object["email"],
            phone: object["phone"],
            address: object["address"],
            city: object["city"],
            country: object["country"],
            delivery_address: "",
            delivery_city: "",
            delivery_country: "",
            custom_1: "",
            custom_2: ""
        };

        // Initiate the payment process
        payhere.startPayment(payment);

    } catch (error) {
        console.error("Error processing payment:", error);
    }
}

// async function updatePaymentStatus(orderId) {
//     payload = {
//         req_id: orderId,
//     };
//
//     try {
//         const response = await fetch('http://localhost:8080/update-payment-status', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify(payload)
//         });
//
//         if (response.ok) {
//             const result = await response.json();
//             console.log('Response: ', result);
//         } else {
//             const error = await response.json();
//             console.error('Error: ', error);
//         }
//     } catch (e) {
//         alert('An error occurred while updating the payment status');
//         console.error('Error: ', e);
//     }
// }
