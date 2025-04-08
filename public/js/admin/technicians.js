let technicianIdToDelete = null; // Store technician ID to delete

// Open modal when the delete button is clicked
document.querySelectorAll(".delete-btn").forEach(button => {
    button.addEventListener("click", (e) => {
        const technicianRow = e.target.closest("tr");
        technicianIdToDelete = technicianRow.getAttribute("data-technician-id"); // Get technician ID
        console.log("Technician ID to delete: ", technicianIdToDelete);
        document.getElementById("delete-modal").classList.remove("hidden"); // Show modal
    });
});

// Cancel delete action
document.getElementById("cancel-delete").addEventListener("click", () => {
    document.getElementById("delete-modal").classList.add("hidden"); // Hide modal
    technicianIdToDelete = null;
});

// Confirm delete action
document.getElementById("confirm-delete").addEventListener("click", () => {
    if (technicianIdToDelete) {
        console.log("Sending request to delete technician ID: ", technicianIdToDelete);
        fetch("/admin/delete-technician", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({tech_id: technicianIdToDelete}),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    console.log("Response from server: ", data);
                    // Find and remove the row from the table
                    const row = document.querySelector(`tr[data-technician-id="${technicianIdToDelete}"]`);
                    row.remove();
                    document.getElementById("delete-modal").classList.add("hidden"); // Hide modal
                    alert("Technician deleted successfully.");
                } else {
                    alert(data.message || "Failed to delete technician.");
                }
                technicianIdToDelete = null; // Reset the technician ID
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred while deleting the technician.");
                technicianIdToDelete = null; // Reset the technician ID
            });
    }
});
