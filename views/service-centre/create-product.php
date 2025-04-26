<?php

use app\core\Application;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Product</title>
    <link rel="stylesheet" href="/css/technician/overlay.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/service-center/add-products.css">
    <link rel="stylesheet" href="/css/service-center/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

<?php

include_once 'components/sidebar.php';
include_once 'components/header.php';

?>

<?php if (Application::$app->session->getFlash('success')): ?>
    <div class="alert alert-success">
        <?php echo Application::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>
<?php if (Application::$app->session->getFlash('error')): ?>
    <div class="alert alert-error">
        <?php echo Application::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>

<div class="create-product-container">
    <!--Product creation form-->
    <h2>Add Products</h2>
    <form action="/service-center-create-product" method="post" enctype="multipart/form-data">
        <label for="description">Description</label>
        <textarea id="description" name="description" required></textarea>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="media">Upload Media:</label>
        <input type="file" id="media" name="media" accept="image/*,video/*" required>

        <label for="product_count">Product Count:</label>
        <input type="number" id="product_count" name="product_count" required>

        <!-- <label for="category">Category:</label> -->
        <!-- <select class="category-select" name="category" id="category" required>
            <option value="">Select a category</option>
            <option value="Tools">Tools</option>
            <option value="Engine & Transmission">Engine & Transmission</option>
            <option value="Brakes & Suspension">Brakes & Suspension</option>
            <option value="Electrical & Electronics">Electrical & Electronics</option>
            <option value="Body Parts & Exterior">Body Parts & Exterior</option>
            <option value="Tires & Wheels">Tires & Wheels</option>
            <option value="Interior Accessories">Interior Accessories</option>
            <option value="Fluids & Maintenance">Fluids & Maintenance</option>
            <option value="Performance & Upgrades">Performance & Upgrades</option>
            <option value="Safety & Security">Safety & Security</option>
        </select> -->

        <button type="submit">Add Product</button>
    </form>

    <!--    List of products -->


    <h2>Your Products</h2>
    <?php if (!empty($products)): ?>
        <table>
            <thead>
            <tr>
                <th>Image</th>
                <th>Description</th>
                <th>Price</th>
                <th>Product count</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td>
                        <img src="/assets/uploads/<?php echo htmlspecialchars($product['media']); ?>"
                             alt="Product Image" width="100">
                    </td>
                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                    <td>Rs. <?php echo htmlspecialchars($product['price']); ?></td>
                    <td><?php echo htmlspecialchars($product['product_count']) ?></td>
                    <td>
                        <form action="/service-center-update-product" method="get">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <button type="submit">Edit</button>
                        </form>

                        <form action="/service-center-delete-product" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <button class="delete-button" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No products have been added yet.</p>
    <?php endif; ?>
</div>


<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/customer-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>
<script src="/js/service-center/overlay.js"></script>
<script src="/js/service-center/service-center-home.js"></script>
</body>

</html>