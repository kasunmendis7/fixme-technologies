document.getElementById('finish-contract-btn')?.addEventListener('click', function () {
    const confirmFinish = confirm("Are you sure you want to finalize this contract?");
    if (confirmFinish) {
        // window.location.href = `/finish-contract/${<?= $contract['contract_id'] ?>}`;
    }
});

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};