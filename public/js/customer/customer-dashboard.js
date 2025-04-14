async function cancelReq(cusId, techId) {
    console.log(`${cusId}, ${techId}`);

    payload = {
        cus_id: cusId,
        tech_id: techId,
    };


    try {
        const response = await fetch('http://localhost:8080/delete-cus-tech-req', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        if (response.ok) {
            const result = await response.json();
            console.log('Response: ', result);
            window.location.href = `/customer-dashboard`;
        } else {
            const error = await response.json();
            console.error('Error: ', error);
            window.location.href = `/customer-dashboard`;
        }
    } catch (e) {
        alert('An error occurred while sending the request');
        console.error('Error: ', e);
    }
}

async function getAdvancePayments(cusId) {
    window.location.href = `/customer-advance-payments`;
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
            // Validate the payment and show success or failure page to the customer
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
            merchant_id: "1230101",               // Replace with your Merchant ID
            return_url: "http://localhost:8080/customer-dashboard",// Important
            cancel_url: "http://localhost:8080/customer-dashboard",// Important
            notify_url: "http://localhost:8080/payhere-notification",
            order_id: object["order_id"],  // Replace with generated order id from backend
            items: object["items"],        // Replace with generated item name from backend
            amount: object["amount"],      // Replace with generated amount from backend
            currency: object["currency"],  // Replace with generated currency from backend
            hash: object["hash"],          // Replace with generated hash from backend
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
