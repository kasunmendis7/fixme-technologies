function viewRequest(customerId, req_id = null) {
    /* Redirect to the customer request page */
    fetch('http://localhost:8080/mark-request-viewed', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({req_id}),
    })
        .then(response => {
            if (response.ok) {
                console.log('Request marked as viewed');
                const acceptButton = document.getElementById(`accept-btn-${req_id}`);
                if (acceptButton) {
                    acceptButton.disabled = true;
                }
            } else {
                console.error('Failed to mark request as viewed');
            }
        })
        .catch(error => console.error('Error:', error));
    window.location.href = `/customer-request/${customerId}?req_id=${req_id}`;
}