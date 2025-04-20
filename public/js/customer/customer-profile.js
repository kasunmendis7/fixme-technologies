document.addEventListener('DOMContentLoaded', () => {
    const editProfileBtn = document.getElementById('editProfileBtn'); // The "Edit Profile" button
    const saveProfileBtn = document.getElementById('saveProfileBtn'); // The "Save Changes" button
    const changePhotoBtn = document.getElementById('changePhotoBtn'); // The "Change Photo" button
    const editInputs = document.querySelectorAll('.edit-input'); // All editable input fields
    const displayParagraphs = document.querySelectorAll('p'); // All display-only paragraphs

    // Initially hide the "Change Photo" button
    changePhotoBtn.style.display = 'none';

    // Add event listener to enable edit mode
    editProfileBtn.addEventListener('click', () => {
        // Show the "Change Photo" button
        changePhotoBtn.style.display = 'inline-block';

        // Show editable fields and hide static display fields
        editInputs.forEach(input => input.style.display = 'inline');
        displayParagraphs.forEach(display => display.style.display = 'none');

        // Show the "Save Changes" button and hide the "Edit Profile" button
        saveProfileBtn.style.display = 'inline';
        editProfileBtn.style.display = 'none';
    });

    // Add event listener to disable edit mode (on save)
    saveProfileBtn.addEventListener('click', () => {
        // Hide the "Change Photo" button again
        changePhotoBtn.style.display = 'none';

        // Hide editable fields and show static display fields
        editInputs.forEach(input => input.style.display = 'none');
        displayParagraphs.forEach(display => display.style.display = 'inline');

        // Show the "Edit Profile" button and hide the "Save Changes" button
        editProfileBtn.style.display = 'inline';
        saveProfileBtn.style.display = 'none';
    });
});
