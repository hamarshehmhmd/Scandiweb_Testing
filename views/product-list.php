<!-- views/product-list.php -->
<?php include 'views/templates/header.php'; ?>

<div class="container mt-4">
    <form id="productForm" method="post" action="index.php">
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="product-item card">
                        <div class="card-body text-center">
                            <input type="checkbox" class="delete-checkbox mb-2" name="delete[]" value="<?= $product['sku'] ?>">
                            <h5 class="card-title"><?= $product['sku'] ?></h5>
                            <p class="card-text"><?= $product['name'] ?></p>
                            <p class="card-text">$<?= $product['price'] ?></p>
                            <p class="card-text"><?= $product['attribute'] ?> </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <input type="hidden" name="mass_delete" value="1">
    </form>
</div>

<?php include 'views/templates/footer.php'; ?>
