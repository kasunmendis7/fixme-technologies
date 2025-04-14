document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("payment-form");
    const tableBody = document.querySelector("#payment-methods-table tbody");

    fetchPaymentMethods();

    async function fetchPaymentMethods() {
        try {
            const response = await fetch('/get-customer-payment-methods', {method: 'GET'});
            const result = await response.json();

            if (result.success) {
                populatePaymentMethods(result.data);
            } else {
                alert('Failed to fetch payment methods.' + result.message);
            }
        } catch (error) {
            console.error('Error fetching payment methods', error);
        }
    }

    function populatePaymentMethods(paymentMethods) {
        tableBody.innerHTML = '';

        paymentMethods.forEach(method => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${method.card_type}</td>
                <td>**** ${method.last_four}</td>
                <td>${method.exp_date}</td>
                <td>
                    <button class="edit-btn" data-id="${method.cus_pay_opt_id}">Edit</button>
                    <button class="delete-btn" data-id="${method.cus_pay_opt_id}">Remove</button>
                </td> 
            `;
            tableBody.appendChild(row);
        });

        // Add event listeners to Edit and Remove buttons
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", handleEdit);
        });

        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", handleRemove);
        });

    }

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
                form.reset();
                await fetchPaymentMethods(); // refresh payment methods
            } else {
                alert("Failed to add payment method.");
            }
        } catch (error) {
            console.error("Error occurred:", error);
            alert("An error occurred while adding the payment method.");
        }
    });

    // Handle remove payment method
    async function handleRemove(event) {
        const paymentMethodId = event.target.getAttribute("data-id");

        if (confirm("Are you sure you want to remove this payment method?")) {
            try {
                const response = await fetch(`/delete-customer-payment-method/${paymentMethodId}`, {method: "POST"});
                const result = await response.json();

                if (result.success) {
                    fetchPaymentMethods(); // Refresh the table
                } else {
                    alert("Failed to remove payment method: " + result.message);
                }
            } catch (error) {
                console.error("Error deleting payment method:", error);
            }
        }
    }

    // Handle edit payment method
    function handleEdit(event) {
        const paymentMethodId = event.target.getAttribute("data-id");

        // Open a modal or redirect for editing
        alert(`Open edit form for Payment Method ID: ${paymentMethodId}`);
    }
});