// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};


textarea.addEventListener("input", () => {
    if (textarea.value != '')
        postbtn.disabled = false;
    else
        postbtn.disabled = true;
})

// Select all like icons
const likeIcons = document.querySelectorAll('.like-icon ion-icon');

// Add click event listeners to each like icon
likeIcons.forEach(icon => {
    icon.addEventListener('click', () => {
        // Toggle between filled and outline icon
        if (icon.name === 'build-outline') {
            icon.name = 'build';  // Set to filled icon
        } else {
            icon.name = 'build-outline';  // Set back to outline icon
        }
    });
});
