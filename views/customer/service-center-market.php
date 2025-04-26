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
    <link rel="stylesheet" href="/css/customer/overlay.css">
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
                    <form action="/service-center-add-to-cart" method="post">
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
<!-- Overlay for the confirmation message -->
<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/customer-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>
<!-- JavaScript Files -->
<script src="/js/customer/overlay.js"></script>
<script src="/js/service-center/cart.js"></script>
<script src="/js/service-center/product-count.js"></script>

</body>
</html>