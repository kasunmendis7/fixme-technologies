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
    <title>Cart</title>
    <style>
        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .cart-header {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
        }

        .item-details {
            flex: 1;
        }

        .item-details h2 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .item-details p {
            margin: 5px 0;
        }

        .remove-from-cart-btn {
            background: #ff4d4d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .remove-from-cart-btn:hover {
            background: #ff1a1a;
        }

        .cart-summary {
            margin-top: 30px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .cart-summary h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .cart-summary p {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .checkout-btn {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 1.2rem;
        }

        .checkout-btn:hover {
            background: #45a049;
        }
    </style>
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

<div class="cart-container">
    <h1 class="cart-header">Your Cart</h1>
    <div class="cart-items">
        <?php if (!empty($cartItems)): ?>
            <?php 
                $totalItems = 0;
                $totalCost = 0;
            ?>
            <?php foreach ($cartItems as $item): ?>
                <?php 
                    $totalItems += $item['quantity'];
                    $totalCost += $item['price'] * $item['quantity'];
                ?>
                <div class="cart-item">
                    <img src="/assets/uploads/<?php echo htmlspecialchars($item['media']); ?>" alt="Product Image">
                    <div class="item-details">
                        <h2><?php echo htmlspecialchars($item['description']); ?></h2>
                        <p>Price: Rs. <?php echo htmlspecialchars($item['price']); ?></p>
                        <p>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
                        <p>product_id: <?php echo htmlspecialchars($item['product_id']); ?></p>
                        <form action="/remove-from-serv-cen-cart" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id'] ?>">
                            <button class="remove-from-cart-btn" type="submit">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <?php if (!empty($cartItems)): ?>
        <div class="cart-summary">
            <h2>Cart Summary</h2>
            <p>Total Items: <?php echo $totalItems; ?></p>
            <p>Total Cost: Rs. <?php echo $totalCost; ?></p>
            <button class="checkout-btn" onclick="window.location.href='/service-center-check-out-page'">Proceed to Checkout</button>
        </div>
    <?php endif; ?>
</div>


</body>
</html>