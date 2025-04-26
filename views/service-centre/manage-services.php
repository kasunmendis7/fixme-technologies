<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage services</title>
    <link rel="stylesheet" href="/css/technician/technician-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/service-center/notification.css">
    <link rel="stylesheet" href="/css/service-center/manage-services.css">
    <link rel="stylesheet" href="/css/customer/flash-messages.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <?php
    include_once 'components/sidebar.php';
    include_once 'components/header.php';
    ?>

    <div class="service-management-container">
        <h1 class="title">Manage Your Services</h1>
        <div id="services-list">
            <!-- Services will be loaded here -->
        </div>

        <div id="no-services" style="display:none;">
            <p class="no-services-text">You have not added any services yet.</p>
            <a href="/add-services" class="add-service-button">Add Services</a>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', loadServices);

        function loadServices() {
            fetch('/get-services-by-service-center')
                .then(response => response.json())
                .then(data => {
                    const listContainer = document.getElementById('services-list');
                    const noServices = document.getElementById('no-services');

                    listContainer.innerHTML = ''; // Clear previous

                    if (data.length === 0) {
                        noServices.style.display = 'block';
                        return;
                    }

                    data.forEach(service => {
                        const card = document.createElement('div');
                        card.className = 'service-card';
                        card.innerHTML = `
                    <span class="service-name" data-id="${service.id}">${escapeHtml(service.name)}</span>
                    <div class="service-actions">
                        <button class="edit" onclick="editService(${service.id}, '${escapeHtml(service.name)}')">Edit</button>
                        <button class="delete" onclick="deleteService(${service.id})">Delete</button>
                    </div>
                `;
                        listContainer.appendChild(card);
                    });
                })
                .catch(error => console.error('Error loading services:', error));
        }

        function escapeHtml(text) {
            var div = document.createElement("div");
            div.textContent = text;
            return div.innerHTML;
        }

        function editService(id, currentName) {
            const newName = prompt('Edit service name:', currentName);
            if (newName && newName.trim() !== '' && newName !== currentName) {
                fetch(`/update-service`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: id, name: newName })
                })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert('Service updated successfully!');
                            loadServices();
                        } else {
                            alert('Failed to update service.');
                        }
                    })
                    .catch(error => console.error('Error updating service:', error));
            }
        }

        function deleteService(id) {
            if (confirm('Are you sure you want to delete this service?')) {
                fetch(`/delete-service`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: id })
                })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert('Service deleted successfully!');
                            loadServices();
                        } else {
                            alert('Failed to delete service.');
                        }
                    })
                    .catch(error => console.error('Error deleting service:', error));
            }
        }
    </script>

</body>





</html>