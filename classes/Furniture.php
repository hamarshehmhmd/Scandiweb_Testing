<?php

require_once 'Product.php';

class Furniture extends Product {
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price, $height, $width, $length) {
        parent::__construct($sku, $name, $price);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getAttribute() {
        return "Dimensions: " . $this->height . "x" . $this->width . "x" . $this->length;
    }

    public function save($queryBuilder) {
        $conn = $queryBuilder->getConnection();
        $type = 2; // Set type as integer
        $attribute = $this->height . "x" . $this->width . "x" . $this->length;
        $query = "INSERT INTO products (sku, name, price, type, attribute) VALUES (:sku, :name, :price, :type, :attribute)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':attribute', $attribute);
        return $stmt->execute();
    }
}
?>
