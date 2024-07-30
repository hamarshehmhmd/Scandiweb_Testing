<?php

abstract class Product {
    protected $sku;
    protected $name;
    protected $price;

    public function __construct($sku, $name, $price) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    abstract public function getAttribute();
    abstract public function save($queryBuilder);

    public static function getAll($conn) {
        $query = "SELECT * FROM products ORDER BY sku";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $mappedProducts = array_map(function($product) {
            return self::mapProduct($product);
        }, $products);

        return $mappedProducts;
    }

    public static function delete($conn, $skus) {
        if (empty($skus)) {
            return false;
        }
        $placeholders = implode(',', array_fill(0, count($skus), '?'));
        $query = "DELETE FROM products WHERE sku IN ($placeholders)";
        $stmt = $conn->prepare($query);
        return $stmt->execute($skus);
    }

    private static function mapProduct($product) {
        $productClass = self::getProductClass($product['type']);
        return new $productClass($product['sku'], $product['name'], $product['price'], $product['attribute']);
    }

    private static function getProductClass($type) {
        $types = [
            0 => 'DVD',
            1 => 'Book',
            2 => 'Furniture',
        ];

        if (!array_key_exists($type, $types)) {
            throw new Exception("Unknown product type");
        }

        return $types[$type];
    }
}
