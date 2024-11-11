function filterTechnicians() {
    const searchInput = document.getElementById('technician-search').value.toLowerCase();
    const technicians = document.querySelectorAll('.technician-card');

    technicians.forEach(technician => {
            const name = technician.getAttribute('data-name');
            if (name.includes(searchInput)) {
                technician.style.display = 'block'; // Show matching cards
            } else {
                technician.style.display = 'none'; // Hide non-matching cards
            }
        });
}