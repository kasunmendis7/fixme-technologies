<div id="service-list-container"
    style="display: flex; justify-content: center; align-items: center; min-height: 300px;">
    <!-- Dynamic content will be loaded here -->
</div>

<form id="services-form" method="post" action="/add-services"
    style="display: none; text-align: center; margin-top: 20px;">
    <div id="service-fields" style="margin-bottom: 15px;">
        <input type="text" name="services[]" placeholder="Enter Service" required class="service-input">
    </div>

    <button type="button" id="add-more" class="btn btn-secondary">+ Add More Services</button>
    <br><br>
    <button type="submit" class="btn btn-primary">Submit Services</button>
</form>

<script>
    const maxFields = 10;
    let fieldCount = 1;

    window.addEventListener('DOMContentLoaded', fetchServices);

    function fetchServices() {
        fetch('/get-services')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('service-list-container');
                container.innerHTML = ''; // Clear first

                const card = document.createElement('div');
                card.className = 'card';

                if (data.length === 0) {
                    // No services added yet
                    card.innerHTML = `
                    <p style="color: red;">No services added yet!</p>
                    <button id="show-service-form" class="btn btn-primary">Add Services</button>
                `;
                } else {
                    // Services already exist
                    card.innerHTML = `
                    <p style="color: green;">Services already added! <br> Visit the <b>Services</b> tab to update or delete them.</p>
                `;
                }

                container.appendChild(card);

                // Add event listener if add button appears
                document.getElementById('show-service-form')?.addEventListener('click', () => {
                    document.getElementById('services-form').style.display = 'block';
                    document.getElementById('show-service-form').style.display = 'none';
                });
            })
            .catch(error => {
                console.error('Error fetching services:', error);
            });
    }


    // Escape HTML to prevent XSS
    function escapeHtml(text) {
        var div = document.createElement("div");
        div.textContent = text;
        return div.innerHTML;
    }

    document.getElementById('add-more')?.addEventListener('click', () => {
        if (fieldCount >= maxFields) {
            alert("You can only add up to 10 services.");
            return;
        }

        const fieldContainer = document.getElementById('service-fields');
        const newInput = document.createElement('input');
        newInput.type = "text";
        newInput.name = "services[]";
        newInput.placeholder = `Enter Service ${fieldCount + 1}`;
        newInput.required = true;
        newInput.className = 'service-input'; // 👉 Important! Add the class here
        fieldContainer.appendChild(newInput);

        fieldCount++;
    });


    document.getElementById('services-form').addEventListener('submit', (e) => {
        // Optional: add loading or disable submit button
    });
</script>