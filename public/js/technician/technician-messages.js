document.addEventListener("DOMContentLoaded", function () {
    const checkAllBtn = document.querySelector(".mailbox-controls .btn.default-btn");
    const checkboxes = document.querySelectorAll(".mailbox-messages input[type='checkbox']");

    checkAllBtn.addEventListener("click", function () {
        checkboxes.forEach(checkbox => {
            checkbox.checked = !checkbox.checked;
        });
    });
});

