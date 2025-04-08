document.getElementById('editProfileBtn').addEventListener('click', function () {
    document.querySelectorAll('.edit-input').forEach(input => input.style.display = 'inline');
    document.querySelectorAll('p').forEach(display => display.style.display = 'none');
    
    // Show the "Save Changes" button and hide the "Edit Profile" button
    document.getElementById('saveProfileBtn').style.display = 'inline';
    this.style.display = 'none';
});
