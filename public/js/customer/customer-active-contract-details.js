// document.getElementById('finish-contract-btn')?.addEventListener('click', function () {
//     const confirmFinish = confirm("Your contract ID will be shared with the technician to finish the contract.");
//     if (confirmFinish) {
//         // window.location.href = `/finish-contract/${<?= $contract['contract_id'] ?>}`;
//     }
// });

function finishContract(contractId) {
    window.location.href = `/customer-finish-contract/${contractId}`;
    window.location.reload();
}
