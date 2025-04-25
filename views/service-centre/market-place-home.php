<?php

use app\core\Application;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Marketplace</title>
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

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            if (dropdown.style.display === 'none' || dropdown.style.display === '') {
                dropdown.style.display = 'block';
            } else {
                dropdown.style.display = 'none';
            }
        }

        // Close the dropdown if user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.dropdown-toggle') && !event.target.matches('.dropdown-toggle *')) {
                const dropdown = document.getElementById('profileDropdown');
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            }
        }
    </script>

    <section>
        <div class="flash-message">
            <?php if (Application::$app->session->getFlash('success')): ?>
                <div class="alert alert-success">
                    <?php echo Application::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Main Content with Sidebar -->
    <section class="marketplace-container">
        <!-- Categories Sidebar -->
        <!-- <aside class="categories-sidebar">
        <h3 class="categories-title">Product Categories</h3>
        <ul class="categories-list">
            <li><a href="/get-product-by-category?category=all" class="category-link" data-category="all">All</a></li>
            <li><a href="/get-product-by-category?category=tools" class="category-link" data-category="tools">Tools</a>
            </li>
            <li><a href="/get-product-by-category?category=engine-transmission" class="category-link"
                   data-category="engine-transmission">Engine & Transmission</a></li>
            <li><a href="/get-product-by-category?category=brakes-suspension" class="category-link"
                   data-category="brakes-suspension">Brakes & Suspension</a></li>
            <li><a href="/get-product-by-category?category=electrical-electronics" class="category-link"
                   data-category="electrical-electronics">Electrical & Electronics</a></li>
            <li><a href="/get-product-by-category?category=body-parts-exterior" class="category-link"
                   data-category="body-parts-exterior">Body Parts & Exterior</a></li>
            <li><a href="/get-product-by-category?category=tires-wheels" class="category-link"
                   data-category="tires-wheels">Tires & Wheels</a></li>
            <li><a href="/get-product-by-category?category=interior-accessories" class="category-link"
                   data-category="interior-accessories">Interior Accessories</a></li>
            <li><a href="/get-product-by-category?category=fluids-maintenance" class="category-link"
                   data-category="fluids-maintenance">Fluids & Maintenance</a></li>
            <li><a href="/get-product-by-category?category=performance-upgrades" class="category-link"
                   data-category="performance-upgrades">Performance & Upgrades</a></li>
            <li><a href="/get-product-by-category?category=safety-security" class="category-link"
                   data-category="safety-security">Safety & Security</a></li>
        </ul>
    </aside> -->

        <!-- Marketplace Products Section -->
        <div class="marketplace">
            <h1 class="marketplace-title">Available Products</h1>
            <div class="products-grid">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <img class="product-image" src="/assets/uploads/<?php echo htmlspecialchars($product['media']); ?>"
                                alt="Product Image">
                            <div class="product-details">
                                <h2 class="product-title"><?php echo htmlspecialchars($product['description']); ?></h2>
                                <p class="product-price">Rs. <?php echo htmlspecialchars($product['price']); ?></p>
                                <p class="product-seller">Sold
                                    by: <?php echo htmlspecialchars($product['seller_name']); ?></p>
                                <p>Product id: <?php echo htmlspecialchars($product['product_id']) ?></p>
                            </div>
                            <!-- <a href="/check-out-page" class="product-btn">View Details</a> -->
                            <!-- <button class="add-to-cart-btn" data-product-id="<?php echo $product['product_id']; ?>">Add to Cart</button> -->
                            <form action="/add-to-cart" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                <button class="btn" style="color:black;" type="submit">Add to cart</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-products">No products are available in this category.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
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

    <!-- <script src="/js/service-center/filterProducts.js"></script> -->
    <!-- <script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".category-link").forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent default anchor behavior

            let category = this.getAttribute("data-category");

            // Send an AJAX request to fetch filtered products
            fetch(`/get-product-by-category?category=${category}`, {
                method: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("product-list").innerHTML = data; // Update the product list
            })
            .catch(error => console.error("Error:", error));
        });
    });
});
</script> -->

    <script src="/js/service-center/cart.js"></script>
    <script src="/js/service-center/product-count.js"></script>

    <script>
        function saveCurrentLocation() {
            const currentRoute = window.location.pathname;
            let routes = JSON.parse(localStorage.getItem('visitedRoutes')) || [];

            if (!routes.includes(currentRoute)) {
                routes.push(currentRoute);
                localStorage.setItem('visitedRoutes', '/market-place-home');
            }
        }
        window.addEventListener('DOMContentLoaded', saveCurrentLocation);
    </script>

</body>

</html>