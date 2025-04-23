async function downloadInvoice() {
    const baseUrl = window.location.origin;
    const url = window.location.href;

    const contractId = url.split('/').pop(); // Extract contract ID from the current URL
    const invoiceUrl = `${baseUrl}/technician-download-invoice/${contractId}`;

    if (contractId) {
        window.location.href = invoiceUrl;
    } else {
        console.log("Download invoice failed");
    }
}