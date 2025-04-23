document.getElementById('finish-contract-btn')?.addEventListener('click', function () {
    const confirmFinish = confirm("Are you sure you want to finalize this contract?");
    if (confirmFinish) {
        // window.location.href = `/finish-contract/${<?= $contract['contract_id'] ?>}`;
    }
});
