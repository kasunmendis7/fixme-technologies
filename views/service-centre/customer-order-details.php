<?php
use app\core\Application;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/css/service-center/order-details.css">
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
                        <a href="/customer-order-details"
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

    <div class="order-container">
        <!-- Checkout Info -->
        <div class="checkout-info">
            <h2><i class="fas fa-user-circle"></i> Customer Information</h2>
            <p><i class="fas fa-user"></i> <?= $checkoutInfo['full_name'] ?? 'N/A' ?></p>
            <p><i class="fas fa-envelope"></i> <?= $checkoutInfo['email'] ?? 'N/A' ?></p>
            <p><i class="fas fa-phone"></i> <?= $checkoutInfo['phone'] ?? 'N/A' ?></p>
            <p><i class="fas fa-map-marker-alt"></i> <?= $checkoutInfo['address'] ?? '' ?>,
                <?= $checkoutInfo['city'] ?? '' ?> (<?= $checkoutInfo['postal_code'] ?? '' ?>)</p>
        </div>

        <!-- Loop through each order -->
        <?php foreach ($orders as $order): ?>
            <div class="order-details">
                <h2><i class="fas fa-box"></i> Order #<?= $order['order_id'] ?> <span
                        class="status <?= strtolower($order['status']) ?>"><?= ucfirst($order['status']) ?></span></h2>

                <ul>
                    <?php foreach ($orderDetails[$order['order_id']] as $item): ?>
                        <li class="order-item">
                            <div class="item-icon"><i class="fas fa-tools"></i></div>
                            <div class="item-details">
                                <strong><?= $item['description'] ?></strong>
                                <span>Qty: <?= $item['quantity'] ?></span>
                                <span>Price: Rs. <?= number_format($item['price'], 2) ?></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>




    <div class="container-f">
        <footer class="py-5">
            <div class="row">
                <div class="col-6 col-md-2 mb-3">
                    <h3 class="ml-3">FixMe</h3>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <h5>Company</h5>
                    <ul class="nav-f flex-column">
                        <li class="nav-item-f mb-2"><a href="#" class="nav-link-f p-0 text-body-secondary">About Us</a>
                        </li>
                        <li class="nav-item-f mb-2"><a href="#" class="nav-link-f p-0 text-body-secondary">Our
                                Offerings</a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-md-2 mb-3">
                    <h5>Products</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item-f mb-2"><a href="#" class="nav-link-f p-0 text-body-secondary">Nearby
                                Technicians</a></li>
                        <li class="nav-item-f mb-2"><a href="#" class="nav-link-f p-0 text-body-secondary">Service
                                Centers</a></li>
                        <li class="nav-item-f mb-2"><a href="#" class="nav-link-f p-0 text-body-secondary">Service
                                Center
                                Marketplace</a></li>
                    </ul>
                </div>

                <div class="col-6 col-md-2 mb-3">
                    <h5>Safety Measures</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item-f mb-2"><a href="#" class="nav-link-f p-0 text-body-secondary">Safety</a>
                        </li>
                        <li class="nav-item-f mb-2"><a href="#" class="nav-link-f p-0 text-body-secondary">Diversity and
                                Inclusion</a></li>
                    </ul>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 mx-4 border-top">
                <p>© 2024 Fixme Technologies Inc.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-body-emphasis" href="#">
                            <svg class="bi" width="24" height="24">
                                <use xlink:href="#twitter"></use>
                            </svg>
                        </a></li>
                    <li class="ms-3"><a class="link-body-emphasis" href="#">
                            <svg class="bi" width="24" height="24">
                                <use xlink:href="#instagram"></use>
                            </svg>
                        </a></li>
                    <li class="ms-3"><a class="link-body-emphasis" href="#">
                            <svg class="bi" width="24" height="24">
                                <use xlink:href="#facebook"></use>
                            </svg>
                        </a></li>
                </ul>
            </div>
        </footer>
    </div>

    <script src="/js/service-center/cart.js"></script>
    <script src="/js/service-center/product-count.js"></script>

</body>

</html>