document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("payment-form");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        // Gather user input data
        const cardNumber = document.getElementById("card_number").value;
        const expiryDate = document.getElementById("expiry_date").value;
        const cardName = document.getElementById("card_name").value;

        // Validate inputs (optional)
        if (!cardNumber || !expiryDate || !cardName) {
            alert("Please fill in all fields");
            return;
        }

        // Prepare data to send to backend
        const data = {
            card_number: cardNumber,
            expiry_date: expiryDate,
            card_name: cardName,
        };

        try {
            // AJAX request to backend to store the payment method
            const response = await fetch("/customer-payment-method", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            });

            // Parse response
            const result = await response.json();
            if (result.success) {
                alert("Payment method added successfully!");
                form.reset();
            } else {
                alert("Failed to add payment method.");
            }
        } catch (error) {
            console.error("Error occurred:", error);
            alert("An error occurred while adding the payment method.");
        }
    });
});