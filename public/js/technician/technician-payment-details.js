document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".payment-form");
    const paymentContainer = document.querySelector(".payment-container");

    fetchBankAccounts();

    async function fetchBankAccounts() {
        try {
            const response = await fetch('/get-technician-payment-methods', {method: 'GET'});
            const result = await response.json();

            if (result.success) {
                populateBankAccounts(result.data);
            } else {
                console.error('Failed to fetch bank accounts:', result.message);
            }
        } catch (error) {
            console.error('Error fetching bank accounts', error);
        }
    }

    function populateBankAccounts(bankAccounts) {
        paymentContainer.innerHTML = '';

        if (bankAccounts.length === 0) {
            paymentContainer.innerHTML = '<p>No bank accounts found. Please add a bank account.</p>';
            return;
        }

        bankAccounts.forEach(account => {
            const accountCard = document.createElement('div');
            accountCard.className = 'payment-card-1';
            accountCard.innerHTML = `
                <div class="img-box">
                    <img src="https://w7.pngwing.com/pngs/98/991/png-transparent-computer-icons-bank-icon-design-screenshot-bank-blue-angle-logo-thumbnail.png"
                         alt="Bank Logo">
                </div>
                <div class="number">
                    <span>**** **** **** ${account.last_four}</span>
                </div>
                <div class="details">
                    <span>Name: ${account.bank_acc_name}</span>
                    <span>Branch: ${account.bank_acc_branch || 'Not specified'}</span>
                </div>
                <div class="actions">
<!--                    <button class="edit-btn" data-id="${account.tech_pay_opt_id}">Edit</button>-->
                    <button class="delete-btn" data-id="${account.tech_pay_opt_id}">Remove</button>
                </div>
            `;
            paymentContainer.appendChild(accountCard);
        });

        // Add event listeners to Edit and Remove buttons
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", handleEdit);
        });

        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", handleRemove);
        });
    }

    // Fix form element IDs and add submit event listener
    const accountNumberInput = document.getElementById("card-number");
    const accountNameInput = document.querySelector("input[placeholder='Enter bank account name']");
    const branchInput = document.querySelector("input[placeholder='Enter bank branch']");
    const addButton = document.querySelector(".payment-form button");

    addButton.addEventListener("click", async () => {
        // Gather user input data
        const accountNumber = accountNumberInput.value;
        const accountName = accountNameInput.value;
        const branch = branchInput.value;

        // Validate inputs
        if (!accountNumber || !accountName) {
            alert("Please fill in all required fields");
            return;
        }

        // Prepare data to send to backend
        const data = {
            bank_acc_num: accountNumber,
            bank_acc_name: accountName,
            bank_acc_branch: branch
        };

        try {
            // AJAX request to backend to store the bank account
            const response = await fetch("/technician-payment-method", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            });

            // Parse response
            const result = await response.json();
            if (result.success) {
                // Reset form
                accountNumberInput.value = '';
                accountNameInput.value = '';
                branchInput.value = '';

                // Refresh bank accounts list
                await fetchBankAccounts();
            } else {
                alert("Failed to add bank account: " + result.message);
            }
        } catch (error) {
            console.error("Error occurred:", error);
            alert("An error occurred while adding the bank account.");
        }
    });

    // Handle remove bank account
    async function handleRemove(event) {
        const paymentMethodId = event.target.getAttribute("data-id");

        if (confirm("Are you sure you want to remove this bank account?")) {
            try {
                const response = await fetch(`/delete-technician-payment-method/${paymentMethodId}`, {
                    method: "POST"
                });
                const result = await response.json();

                if (result.success) {
                    fetchBankAccounts(); // Refresh the list
                } else {
                    alert("Failed to remove bank account: " + result.message);
                }
            } catch (error) {
                console.error("Error deleting bank account:", error);
                alert("An error occurred while removing the bank account.");
            }
        }
    }

    // Handle edit bank account
    function handleEdit(event) {
        const paymentMethodId = event.target.getAttribute("data-id");

        // You could implement an edit form/modal here
        alert(`Edit functionality for bank account ID: ${paymentMethodId} is not implemented yet.`);

        // If you want to implement edit functionality in the future,
        // you would need to fetch the specific account details and populate a form
    }
});
