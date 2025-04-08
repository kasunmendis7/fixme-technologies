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
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/service-center/market-place-product-view.css">
    <script src="/js/home/main.js"></script>
    <script src="/js/technician/main.js"></script>
    <script src="/js/service-center/marketplace-home.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Market Place</title>
</head>

<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
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
    <aside class="categories-sidebar">
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
    </aside>

    <!-- Marketplace Products Section -->
    <div class="marketplace">
        <h1 class="marketplace-title">Available Products</h1>
        <div class="products-grid">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <img class="product-image"
                             src="/assets/uploads/<?php echo htmlspecialchars($product['media']); ?>"
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

</body>
</html>