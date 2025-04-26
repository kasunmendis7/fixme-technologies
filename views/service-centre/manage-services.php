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
        <h1 class="title-1">Manage Your Services</h1>

        <div id="services-list"></div>

        <div id="no-services" style="display:none;">
            <p class="no-services-text">You have not added any services yet.</p>
        </div>

        <button class="add-service-button" onclick="showAddServiceForm()">Add Service</button>

        <div class="add-service-form" id="add-service-form" style="display:none;">
            <input type="text" id="new-service-name" class="service-input" placeholder="Enter service name">
            <button class="save-button" onclick="addService()">Save</button>
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

                    listContainer.innerHTML = '';

                    if (data.length === 0) {
                        noServices.style.display = 'block';
                        return;
                    }

                    noServices.style.display = 'none';

                    data.forEach(service => {
                        const card = document.createElement('div');
                        card.className = 'service-card';
                        card.innerHTML = `
            <span class="service-name" data-id="${service.id}">${escapeHtml(service.name)}</span>
            <div class="service-actions">
              <button class="save-button" onclick="editService(${service.id}, '${escapeHtml(service.name)}')">Edit</button>
              <button class="save-button" onclick="deleteService(${service.id})" style="background-color:#dc3545;">Delete</button>
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

        function showAddServiceForm() {
            document.getElementById('add-service-form').style.display = 'block';
        }

        function addService() {
            const serviceName = document.getElementById('new-service-name').value.trim();
            if (serviceName === '') {
                alert('Please enter a service name.');
                return;
            }

            fetch('/add-service-from-manage-console', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ name: serviceName })
            })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        document.getElementById('new-service-name').value = '';
                        document.getElementById('add-service-form').style.display = 'none';
                        loadServices();
                    } else {
                        alert('Failed to add service.');
                    }
                })
                .catch(error => console.error('Error adding service:', error));
        }

        function editService(id, currentName) {
            const serviceNameSpan = document.querySelector(`.service-name[data-id="${id}"]`);
            const serviceActions = serviceNameSpan.nextElementSibling;

            serviceNameSpan.outerHTML = `
      <input type="text" id="edit-service-${id}" value="${currentName}" class="service-input">
    `;

            serviceActions.innerHTML = `
      <button class="save-button" onclick="saveEditedService(${id})">Save</button>
    `;
        }

        function saveEditedService(id) {
            const newName = document.getElementById(`edit-service-${id}`).value.trim();
            if (newName === '') {
                alert('Service name cannot be empty.');
                return;
            }

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
                        loadServices();
                    } else {
                        alert('Failed to update service.');
                    }
                })
                .catch(error => console.error('Error updating service:', error));
        }

        function deleteService(id) {
            if (!confirm('Are you sure you want to delete this service?')) return;

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
                        loadServices();
                    } else {
                        alert('Failed to delete service.');
                    }
                })
                .catch(error => console.error('Error deleting service:', error));
        }
    </script>


</body>





</html>