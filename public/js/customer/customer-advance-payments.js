function payNow(pin) {
    alert(`Pay Now to order no ${pin}`);
}

async function rejectPayment(reqId) {
    const response = await fetch(`http://localhost:8080/reject-advance-payment/${reqId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    });
    window.location.href = '/customer-advance-payments';
}