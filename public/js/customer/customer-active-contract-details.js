document.addEventListener("DOMContentLoaded", function () {
    const timelineStep2 = document.querySelector('.marker-2');
    const ongoingText = document.querySelector('.ongoing-p');

    async function updateContractStatus() {
        const response = await fetch(`/get-contract-status/${contractId}`);

        if (response.ok) {
            const data = await response.json();
            const status = data.status;

            if (status === 'ongoing') {
                timelineStep2.classList.add('active');
                ongoingText.innerText = "Technician is currently working on your contract";
            }
        } else {
            console.error("Request failed: ", response.status);
        }
    }

    setInterval(updateContractStatus, 2000)
})


function finishContract(contractId) {
    window.location.href = `/customer-finish-contract/${contractId}`;
    window.location.reload();
}

function viewProfile(technicianId) {
    /* Redirect to the technician profile page */
    window.location.href = `/technician-profile/${technicianId}`;

    document.getElementById('ratings-reviews-section').scrollIntoView({behavior: 'smooth'});

}