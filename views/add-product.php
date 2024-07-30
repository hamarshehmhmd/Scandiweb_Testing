<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/script.js" defer></script>
    <title>Add Product</title>
</head>
<body>
    <?php include 'views/templates/header.php'; ?>

    <div class="centered-form-wrapper">
        <div class="form-box">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form id="product_form" method="post" action="add-product.php">
                <div class="form-group">
                    <label for="sku">SKU:</label>
                    <input type="text" class="form-control" id="sku" name="sku" required>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="price">Price ($):</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="productType">Type:</label>
                    <select class="form-control" id="productType" name="productType" required onchange="handleProductTypeChange()">
                        <option value="" disabled selected>Select type</option>
                        <option value="DVD">DVD</option>
                        <option value="Book">Book</option>
                        <option value="Furniture">Furniture</option>
                    </select>
                </div>
                <div id="typeAttributes"></div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-primary" value="Save">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'views/templates/footer.php'; ?>
</body>
</html>
