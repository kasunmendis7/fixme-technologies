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
    <link rel="stylesheet" href="/css/technician/overlay.css">

</head>
<body>
<?php
    include_once 'components/sidebar.php';
    include_once 'components/header.php';
?>

<form action="/service-center-update-product" method="post" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">

    <div>
        <label>Description:</label>
        <input type="text" name="description" value="<?php echo htmlspecialchars($product['description']); ?>" required>
    </div>

    <div>
        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
    </div>

    <div>
        <label>Media:</label>
        <input type="file" name="media">
        <p>Current File: <?php echo htmlspecialchars($product['media']); ?></p>
    </div>

    <button type="submit">Update Product</button>
</form>




<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/technician-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>

<script src="/js/technician/overlay.js"></script>

</body>

</html>