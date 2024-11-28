document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function () {
        // Remove 'active' class from all tabs
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        // Add 'active' class to clicked tab
        this.classList.add('active');
    });
});

async function sendRequest(serviceCenterId, customerId) {
    console.log(`${serviceCenterId}, ${customerId}`);
}