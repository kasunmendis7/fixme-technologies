<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/marketplace-edit-product" method="post" enctype="multipart/form-data">
    <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($product->product_id); ?>">

    <label for="description">Description:</label>
    <textarea id="description" name="description"
              required><?php echo htmlspecialchars($product->description); ?></textarea>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" step="0.01" required
           value="<?php echo htmlspecialchars($product->price); ?>">

    <label for="media">Upload Media:</label>
    <input type="file" id="media" name="media" accept="image/*,video/*" required>

    <button type="submit">Add Product</button>
</form>


</body>
</html>