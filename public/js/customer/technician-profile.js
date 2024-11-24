// JavaScript to handle tab switching functionality
document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function () {
        // Remove 'active' class from all tabs
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        // Add 'active' class to clicked tab
        this.classList.add('active');
    });
});

async function sendRequest(technicianId, customerId) {

    const payload = {
        cus_id: customerId,
        tech_id: technicianId
    };

    try {
        const response = await fetch('http://localhost:8080/cus-tech-req', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        if (response.ok) {
            const result = await response.json();
            alert('Request sent successfully!');
            console.log('Response: ', result);
        } else {
            const error = await response.json();
            alert('Failed to send Request');
            console.error('Error: ', error);
        }
    } catch (e) {
        alert('An error occurred while sending the request');
        console.error('Error: ', e);
    }
}