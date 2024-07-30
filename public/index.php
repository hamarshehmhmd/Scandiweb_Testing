<?php

require_once 'autoload.php';
require_once 'config/database.php';
require_once 'controllers/ProductController.php';

$database = new Database();
$conn = $database->getConnection();
$queryBuilder = new QueryBuilder($conn);
$productController = new ProductController($queryBuilder);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mass_delete'])) {
    if (isset($_POST['delete']) && is_array($_POST['delete'])) {
        $productController->deleteProducts($_POST['delete']);
    }
}

$products = $productController->getAllProducts();

include 'views/product-list.php';
?>
