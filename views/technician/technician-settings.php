<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technician Home</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="/css/technician/technician-settings.css">
</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<div class="settings-container">
    <h1 class="settings-title">Profile</h1>
    <form id="profileForm" class="settings-form">
        <input type="file" id="fileInput" accept="image/*" hidden>
        <div class="settings-image-container" id="imageContainer">
            <img src="assets/technician-dashboard/customer02.jpg" alt="user" id="profileImage" class="settings-profile-image">
            <div id="progressContainer" class="settings-progress-container"></div>
        </div>
        <div id="fileError" class="settings-alert settings-alert-failure" style="display: none;">File upload error</div>

        <input type="text" id="username" placeholder="Username" class="settings-input-field">
        <input type="email" id="email" placeholder="Email" class="settings-input-field">
        <input type="password" id="password" placeholder="Password" class="settings-input-field">

        <button type="submit" class="settings-btn settings-btn-outline">Update</button>
    </form>
    <div class="settings-actions">
        <span class="settings-action-link" onclick="showModal()">Delete Account</span>
        <span class="settings-action-link" onclick="signOut()">Sign Out</span>
    </div>
    <div id="updateSuccess" class="settings-alert settings-alert-success" style="display: none;">Profile updated successfully</div>
    <div id="updateError" class="settings-alert settings-alert-failure" style="display: none;">Update failed</div>

    <div class="settings-modal" id="confirmModal">
        <div class="settings-modal-content">
            <span class="settings-close" onclick="hideModal()">&times;</span>
            <div class="settings-modal-body">
                <h3>Are you sure you want to delete your account?</h3>
                <button class="settings-btn btn-failure" onclick="deleteUser()">Yes, I'm sure</button>
                <button class="settings-btn btn-gray" onclick="hideModal()">No, cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript Files -->
<script src="/js/technician/technician-settings.js"></script>
</body>
</html>
