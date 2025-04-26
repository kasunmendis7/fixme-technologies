// JavaScript Code
// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};

document.getElementById('imageContainer').addEventListener('click', () => {
    document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('profileImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

document.getElementById('profileForm').addEventListener('submit', (event) => {
    event.preventDefault();
    // Simulate form submission and show success message
    document.getElementById('updateSuccess').style.display = 'block';
    setTimeout(() => {
        document.getElementById('updateSuccess').style.display = 'none';
    }, 3000);
});

function showModal() {
    document.getElementById('confirmModal').style.display = 'flex';
}

function hideModal() {
    document.getElementById('confirmModal').style.display = 'none';
}

function deleteUser() {
    alert('Account deleted');
    hideModal();
}

function signOut() {
    alert('Signed out');
}
