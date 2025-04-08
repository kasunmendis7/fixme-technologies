<?php

    use app\core\Application;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
    <link rel="stylesheet" href="/css/technician/technician-community.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">
    <link rel="stylesheet" href="/css/service-center/update-product.css">
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

<!--<form action="/service-center-update-product" name="" method="post" enctype="multipart/form-data">-->
<!---->
<!--    --><?php //if (!empty($product)): ?>
<!--<!--        -->--><?php ////foreach ($products as $product): ?>
<!---->
<!--            <input type="hidden" name="product_id" value="--><?php //echo htmlspecialchars($product['product_id']); ?><!--">-->
<!---->
<!--            <div>-->
<!--                <label>Description:</label>-->
<!--                <input type="text" name="description" value="--><?php //echo htmlspecialchars($product['description']); ?><!--">-->
<!--            </div>-->
<!---->
<!--            <div>-->
<!--                <label>Price:</label>-->
<!--                <input type="number" step="0.01" name="price" value="--><?php //echo htmlspecialchars($product['price']); ?><!--">-->
<!---->
<!--            </div>-->
<!--            <div>-->
<!--                <label>Media:</label>-->
<!--                <input type="file" name="media">-->
<!--                <p>Current File: --><?php //echo htmlspecialchars($product['media']); ?><!--</p>-->
<!--            </div>-->
<!--        <button type="submit">Update Product</button>-->
<!---->
<!--        <!--        -->--><?php ////endforeach; ?>
<!---->
<!--    --><?php //else: ?>
<!--        <p>No products have been added yet.</p>-->
<!--    --><?php //endif; ?>
<!---->
<!--</form>-->


<form action="/service-center-update-product" name="" method="post" enctype="multipart/form-data">
    <?php if (!empty($product)): ?>
        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">

        <div>
            <label>Description:</label>
            <input type="text" name="description" value="<?php echo htmlspecialchars($product['description']); ?>">
        </div>

        <div>
            <label>Price:</label>
            <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">
        </div>

        <div>
            <label>Media:</label>
            <input type="file" name="media">
            <?php if (!empty($product['media'])): ?>
            <div style="display: flex; align-items: flex-start; margin-top: 2.5vh">
                <p style="justify-content: center; font-weight: bold">Current File: </p>
            </div>

                <!-- Display the current media -->
                <?php
                $mediaPath = '/assets/uploads/' . htmlspecialchars($product['media']);
                $fileExtension = pathinfo($mediaPath, PATHINFO_EXTENSION);
                ?>
                <?php if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                    <!-- Show image preview -->
                    <img src="<?php echo $mediaPath; ?>" class="current-media-preview" alt="Uploaded Media" style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                <?php elseif (in_array(strtolower($fileExtension), ['mp4', 'webm', 'ogg'])): ?>
                    <!-- Show video preview -->
                    <video controls style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                        <source src="<?php echo $mediaPath; ?>" type="video/<?php echo $fileExtension; ?>">
                        Your browser does not support the video tag.
                    </video>
                <?php else: ?>
                    <p>Preview not available for this file type.</p>
                <?php endif; ?>
            <?php else: ?>
                <p>No file uploaded yet.</p>
            <?php endif; ?>
        </div>

        <button type="submit">Update Product</button>
    <?php else: ?>
        <p>No products have been added yet.</p>
    <?php endif; ?>
</form>



<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/technician-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>

<script src="/js/customer/overlay.js"></script>
<script src="/js/service-center/service-center-home.js"></script>
</body>

</html>