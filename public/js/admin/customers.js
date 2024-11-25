let customerIdToDelete = null; // Store customer ID to delete

// Open modal when the delete button is clicked
document.querySelectorAll(".delete-btn").forEach(button => {
    button.addEventListener("click", (e) => {
        const customerRow = e.target.closest("tr");
        customerIdToDelete = customerRow.getAttribute("data-customer-id"); // Get customer ID
        document.getElementById("delete-modal").classList.remove("hidden"); // Show modal
    });
});

// Cancel delete action
document.getElementById("cancel-delete").addEventListener("click", () => {
    document.getElementById("delete-modal").classList.add("hidden"); // Hide modal
    customerIdToDelete = null;
});

// Confirm delete action
document.getElementById("confirm-delete").addEventListener("click", () => {
    if (customerIdToDelete) {
        fetch("/admin/delete-customer", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({cus_id: customerIdToDelete}),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    // Find and remove the row from the table
                    const row = document.querySelector(`tr[data-customer-id="${customerIdToDelete}"]`);
                    row.remove();
                    document.getElementById("delete-modal").classList.add("hidden"); // Hide modal
                    alert("Customer deleted successfully.");
                } else {
                    alert(data.message || "Failed to delete customer.");
                }
                customerIdToDelete = null; // Reset the customer ID
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred while deleting the customer.");
                customerIdToDelete = null; // Reset the customer ID
            });
    }
});

