function filterServiceCenters() {
    const searchInput = document.getElementById('service-center-search').value.toLowerCase();
    const serviceCenters = document.querySelectorAll('.service-center-card');

    serviceCenters.forEach(serviceCenter => {
        const name = serviceCenter.getAttribute('data-name');
        if (name.includes(searchInput)) {
            serviceCenter.style.display = 'block'; // Show matching cards
        } else {
            serviceCenter.style.display = 'none'; // Hide non-matching cards
        }
    });
}

function viewProfile(serviceCenterId) {
    /* Redirect to the technician profile page */
    window.location.href = `/service-center-profile/${serviceCenterId}`;
}
