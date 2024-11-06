function closeModal() {
    document.querySelector('.modal-dialog').style.display = 'none';
}
textarea.addEventListener("input", () => {
    if (textarea.value != '')
        postbtn.disabled = false;
    else
        postbtn.disabled = true;
})
