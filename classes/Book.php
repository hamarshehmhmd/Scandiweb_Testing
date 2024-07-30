<?php

require_once 'Product.php';

class Book extends Product {
    private $weight;

    public function __construct($sku, $name, $price, $weight) {
        parent::__construct($sku, $name, $price);
        $this->weight = $weight;
    }

    public function getAttribute() {
        return "Weight: " . $this->weight;
    }

    public function save($queryBuilder) {
        $conn = $queryBuilder->getConnection();
        $type = 1; // Set type as integer
        $query = "INSERT INTO products (sku, name, price, type, attribute) VALUES (:sku, :name, :price, :type, :attribute)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':attribute', $this->weight);
        return $stmt->execute();
    }
}
?>
