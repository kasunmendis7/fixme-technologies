<?php

use app\core\Application;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/service-center/marketplace-home.css">
    <link rel="stylesheet" href="/css/technician/technician-dashboard.css">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="/js/service-center/marketplace-home.js"></script>
    <title>Fixme Home</title>
</head>

<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<section id="sellers">
    <div class="seller-container">

        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-container">
                    <div class="product-box">
                        <img src="/assets/products/<?= htmlspecialchars($product['media']) ?>" alt="Product Image">
                        <div class="best-p1-txt">
                            <div class="name-of-p">
                                <p><?= htmlspecialchars($product['description']) ?></p>
                            </div>

                            <div class="price">
                                Rs. <?= htmlspecialchars(number_format($product['price'], 2)) ?>
                            </div>
                            <div class="buy-now">
                                <button><a href="#">Order</a></button>
                            </div>

                            <?php if ($product['ser_cen_id'] === Application::$app->service_center->ser_cen_id): ?>
                                <div class="product-actions">
                                    <button>
                                        <a href="/marketplace-edit-product?product_id=<?= htmlspecialchars($product['product_id']) ?>">Edit</a>
                                    </button>
                                    <form action="/marketplace-delete-product" method="post"
                                          onsubmit="return confirm('Are you sure you want to delete this product?');"
                                          style="display: inline;">
                                        <input type="hidden" name="product_id"
                                               value="<?= htmlspecialchars($product['product_id']) ?>">
                                        <button type="submit">Delete</button>
                                    </form>
                                </div>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products available at the moment.</p>
        <?php endif; ?>

    </div>
</section>

<section id="contact">
    <div class="contact container">
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126743.5863871805!2d79.77380251499042!3d6.922001982313716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo!5e0!3m2!1sen!2slk!4v1728914557712!5m2!1sen!2slk"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>
        <form action="" method="POST">
            <div class="form">
                <div class="form-txt">
                    <h4>INFORMATION</h4>
                    <h1>Contact Us</h1>
                    <span>Experience top-notch service and support at our state-of-the-art service center, where customer satisfaction is our highest priority.</span>
                </div>
                <div class="form-details">
                    <input type="text" name="name" id="name" placeholder="Name" required>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <textarea name="message" id="message" cols="52" rows="7" placeholder="Message" required></textarea>
                    <button>SEND MESSAGE</button>
                </div>
            </div>
        </form>
    </div>
</section>

</body>
</html>
