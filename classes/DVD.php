<?php

require_once 'Product.php';

class DVD extends Product {
    private $size;

    public function __construct($sku, $name, $price, $size) {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }

    public function getAttribute() {
        return "Size: " . $this->size;
    }

    public function save($queryBuilder) {
        $conn = $queryBuilder->getConnection();
        $type = 0; // Set type as integer
        $query = "INSERT INTO products (sku, name, price, type, attribute) VALUES (:sku, :name, :price, :type, :attribute)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':attribute', $this->size);
        return $stmt->execute();
    }
}
?>
