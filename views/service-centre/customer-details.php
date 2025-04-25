<?php

    use app\core\Application;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer profile</title>
    <link rel="stylesheet" href="/css/service-center/customer-details.css">
    <link rel="stylesheet" href="/css/base/_reset.css">
    <link rel="stylesheet" href="/css/base/_global.css">
    <link rel="stylesheet" href="/css/service-center/market-place-navbar.css">
    <link rel="stylesheet" href="/css/home/footer.css">
    <link rel="stylesheet" href="/css/home/home.css">
    <link rel="stylesheet" href="/css/service-center/marketplace.css">
    <link rel="stylesheet" href="/css/service-center/market-place-product-view.css">
    <script src="/js/home/main.js"></script>
    <script src="/js/technician/main.js"></script>
    <script src="/js/service-center/marketplace-home.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>


    <nav class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img class="logo-img" src="/assets/shopping-cart_market-place.png">
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 link-secondary">Home</a></li>
                <li><a href="/service-centre-landing" class="nav-link px-2">Service Centre</a></li>
                <li><a href="/about-us" class="nav-link px-2">About</a></li>
                <li class="position-relative">
                    <a href="/view-cart" class="nav-link px-2" style="position: relative; display: inline-block;">
                        <ion-icon name="cart-outline" style="font-size: 24px;  color: #fff;"></ion-icon>
                        <span id="cart-count" class="position-absolute badge rounded-pill bg-danger" style="
                        display: none;
                        top: -5px;
                        right: -10px;
                        font-size: 0.65rem;
                        background-color: #dc3545;
                        color: white;
                        padding: 3px 6px;
                        border-radius: 50%;
                        box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
                        min-width: 18px;
                        text-align: center;
                        font-weight: bold;
                        position: absolute;
                    ">
                            0
                        </span>
                    </a>
                </li>
            </ul>

            <div class="dropdown" style="margin-right: 15px;">
                <?php
                $userId = Application::$app->session->get('customer');

                if ($userId) {
                    $customerClass = Application::$app->customerClass;
                    $customerInstance = new $customerClass();
                    $customer = $customerInstance->findOne(['cus_id' => $userId]);
                    $username = $customer->fname;
                    $userProfile = $customer->profile_picture;
                    ?>
                    <div class="dropdown-toggle" style="display: flex; align-items: center; gap: 10px; cursor: pointer;"
                        onclick="toggleDropdown()">
                        <?php
                        if (!empty($userProfile)) {
                            echo '<img src="/assets/uploads/' . htmlspecialchars($userProfile) . '" alt="Profile Picture" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">';
                        } else {
                            echo '<img src="/assets/default-profile.svg" alt="Default Profile Picture" style="width: 40px; height: 40px; background-color: white; border-radius: 50%; object-fit: cover;">';
                        }
                        if (!empty($username)) {
                            echo '<span style="font-size: 16px; font-weight: 500; color: #fff;">' . htmlspecialchars($username) . '</span>';
                        }
                        ?>
                    </div>
                    <div id="profileDropdown" class="dropdown-menu"
                        style="display: none; position: absolute; right: 0; background-color: white; min-width: 180px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1; border-radius: 4px; margin-top: 5px;">
                        <a href="/customer-details"
                            style="color: black; padding: 12px 16px; text-decoration: none; display: block; font-size: 14px;">
                            <ion-icon name="person-outline" style="vertical-align: middle; margin-right: 5px;"></ion-icon>
                            My Profile
                        </a>
                        <a href="/customer-orders"
                            style="color: black; padding: 12px 16px; text-decoration: none; display: block; font-size: 14px;">
                            <ion-icon name="bag-outline" style="vertical-align: middle; margin-right: 5px;"></ion-icon> My
                            Orders
                        </a>
                        <div style="height: 1px; background-color: #e0e0e0; margin: 5px 0;"></div>
                        <a href="/customer-logout"
                            style="color: #dc3545; padding: 12px 16px; text-decoration: none; display: block; font-size: 14px;">
                            <ion-icon name="log-out-outline" style="vertical-align: middle; margin-right: 5px;"></ion-icon>
                            Logout
                        </a>
                    </div>
                    <?php
                } else {
                    echo '<button onclick="window.location.href=\'/customer-login\'" style="padding: 8px 16px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">Login</button>';
                }
                ?>
            </div>
        </header>
    </nav>


    <!-- customer-details.php -->
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php if (!empty($customerDetails['profile_picture'])): ?>
                        <img src="/assets/uploads/<?= htmlspecialchars($customerDetails['profile_picture']) ?>"
                            alt="Profile Picture">
                    <?php else: ?>
                        <div class="profile-initials">
                            <?= strtoupper(substr($customerDetails['fname'], 0, 1) . substr($customerDetails['lname'], 0, 1)) ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="profile-title">
                    <h2><?= htmlspecialchars($customerDetails['fname'] . ' ' . $customerDetails['lname']) ?></h2>
                    <p class="profile-subtitle">Customer since
                        <?= date('M d, Y', strtotime($customerDetails['reg_date'])) ?></p>
                </div>
            </div>

            <div class="profile-body">
                <div class="profile-section">
                    <h3>Personal Information <a href="/edit-profile" class="edit-link"><ion-icon
                                name="create-outline"></ion-icon></a></h3>
                    <div class="info-group">
                        <div class="info-item">
                            <span class="info-label"><ion-icon name="mail-outline"></ion-icon> Email</span>
                            <span class="info-value"><?= htmlspecialchars($customerDetails['email']) ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><ion-icon name="call-outline"></ion-icon> Phone</span>
                            <span class="info-value"><?= htmlspecialchars($customerDetails['phone_no']) ?></span>
                        </div>
                    </div>
                </div>

                <div class="profile-section">
                    <h3>Address <a href="/edit-address" class="edit-link"><ion-icon
                                name="create-outline"></ion-icon></a></h3>
                    <div class="info-group">
                        <div class="info-item">
                            <span class="info-label"><ion-icon name="location-outline"></ion-icon> Location</span>
                            <span class="info-value"><?= htmlspecialchars($customerDetails['address']) ?></span>
                        </div>
                    </div>
                </div>

                <div class="profile-actions">
                    <a href="/customer-orders" class="action-button">
                        <ion-icon name="bag-handle-outline"></ion-icon>
                        My Orders
                    </a>
                    <a href="/change-password" class="action-button">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        Change Password
                    </a>
                    <a href="/customer-logout" class="action-button logout">
                        <ion-icon name="log-out-outline"></ion-icon>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- <script>
        // Tab navigation
        document.addEventListener('DOMContentLoaded', function () {
            const navItems = document.querySelectorAll('.sidebar-nav-item');
            const sections = document.querySelectorAll('.profile-section');

            navItems.forEach(item => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Get target section id
                    const targetId = this.getAttribute('data-target');

                    // Remove active class from all nav items and sections
                    navItems.forEach(i => i.classList.remove('active'));
                    sections.forEach(s => s.classList.remove('active'));

                    // Add active class to clicked nav item and target section
                    this.classList.add('active');
                    document.getElementById(targetId).classList.add('active');
                });
            });

            // Personal info edit functionality
            const editPersonalInfoBtn = document.getElementById('edit-personal-info');
            const cancelPersonalEditBtn = document.getElementById('cancel-personal-edit');
            const personalInfoForm = document.getElementById('personal-info-form');

            editPersonalInfoBtn.addEventListener('click', function () {
                const inputs = personalInfoForm.querySelectorAll('input');
                inputs.forEach(input => input.disabled = false);
                personalInfoForm.querySelector('.form-actions').style.display = 'flex';
                this.style.display = 'none';
            });

            cancelPersonalEditBtn.addEventListener('click', function () {
                const inputs = personalInfoForm.querySelectorAll('input');
                inputs.forEach(input => input.disabled = true);
                personalInfoForm.querySelector('.form-actions').style.display = 'none';
                editPersonalInfoBtn.style.display = 'flex';
            });

            // Address edit functionality
            const editAddressBtn = document.getElementById('edit-address-info');
            const cancelAddressBtn = document.getElementById('cancel-address-edit');
            const addressDisplay = document.getElementById('address-display');
            const editAddressForm = document.querySelector('.edit-address-form');

            editAddressBtn.addEventListener('click', function () {
                addressDisplay.style.display = 'none';
                editAddressForm.style.display = 'block';
                document.querySelector('#address-info-form .form-actions').style.display = 'flex';
                this.style.display = 'none';
            });

            cancelAddressBtn.addEventListener('click', function () {
                addressDisplay.style.display = 'block';
                editAddressForm.style.display = 'none';
                document.querySelector('#address-info-form .form-actions').style.display = 'none';
                editAddressBtn.style.display = 'flex';
            });

            // Password strength meter
            const newPasswordInput = document.getElementById('new_password');
            const strengthMeter = document.querySelector('.strength-meter');
            const strengthText = document.getElementById('password-strength-text');

            newPasswordInput.addEventListener('input', function () {
                const password = this.value;
                let strength = 0;
                let message = '';

                if (password.length > 0) {
                    // Calculate password strength
                    if (password.length >= 8) strength += 25;
                    if (password.match(/[a-z]+/)) strength += 25;
                    if (password.match(/[A-Z]+/)) strength += 25;
                    if (password.match(/[0-9]+/)) strength += 25;

                    // Set color based on strength
                    let color;
                    if (strength <= 25) {
                        message = 'Weak';
                        color = '#dc3545';
                    } else if (strength <= 50) {
                        message = 'Fair';
                        color = '#ffc107';
                    } else if (strength <= 75) {
                        message = 'Good';
                        color = '#17a2b8';
                    } else {
                        message = 'Strong';
                        color = '#28a745';
                    }

                    strengthMeter.style.setProperty('--strength-color', color);
                    strengthMeter.style.width = strength + '%';
                    strengthMeter.style.backgroundColor = color;
                    strengthText.textContent = message;
                } else {
                    strengthMeter.style.width = '0';
                    strengthText.textContent = 'Not entered';
                }
            });

            // Initialize map if Google Maps API is available
            // This is a placeholder - you would need to include the Google Maps API script
            // and implement proper map initialization with the customer's coordinates
            if (typeof google !== 'undefined' && document.getElementById('address-map')) {
                const lat = parseFloat(document.getElementById('latitude').value || 0);
                const lng = parseFloat(document.getElementById('longitude').value || 0);

                if (lat && lng) {
                    const map = new google.maps.Map(document.getElementById('address-map'), {
                        center: { lat, lng },
                        zoom: 15
                    });

                    new google.maps.Marker({
                        position: { lat, lng },
                        map: map
                    });
                }
            }
        });
    </script> -->

    <script src="/js/service-center/cart.js"></script>
    <script src="/js/service-center/product-count.js"></script>
</body>

</html>