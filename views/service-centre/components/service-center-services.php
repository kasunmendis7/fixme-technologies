<div id="service-list-container">
    <?php if (empty($services)): ?>
        <p>No services listed yet.</p>
        <button id="show-service-form">Add Services</button>
    <?php else: ?>
        <ul>
            <?php foreach ($services as $service): ?>
                <li><?= htmlspecialchars($service['name']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<form id="services-form" method="POST" action="/service-centre/add-services" style="display:none;">
    <div id="service-fields">
        <input type="text" name="services[]" placeholder="Enter a service" required>
    </div>
    <button type="button" id="add-more">+ Add More Services</button>
    <br><br>
    <button type="submit">Submit Services</button>
</form>


<script>
    const maxFields = 10;
    let fieldCount = 1;

    document.getElementById('show-service-form')?.addEventListener('click', () => {
        document.getElementById('services-form').style.display = 'block';
        document.getElementById('show-service-form').style.display = 'none';
    });

    document.getElementById('add-more')?.addEventListener('click', () => {
        if (fieldCount >= maxFields) {
            alert("You can only add up to 10 services.");
            return;
        }

        const fieldContainer = document.getElementById('service-fields');
        const newInput = document.createElement('input');
        newInput.type = "text";
        newInput.name = "services[]";
        newInput.placeholder = "Enter another service";
        newInput.required = true;
        fieldContainer.appendChild(newInput);
        fieldCount++;
    });
</script>