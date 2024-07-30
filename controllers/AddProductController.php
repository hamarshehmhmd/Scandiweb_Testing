<?php

class AddProductController {
    private $queryBuilder;

    public function __construct($queryBuilder) {
        $this->queryBuilder = $queryBuilder;
    }

    public function saveProduct($data) {
        $sku = $data['sku'];
        $name = $data['name'];
        $price = $data['price'];
        $type = $data['productType'];

        // Create product instance based on type
        $product = $this->createProductInstance($type, $sku, $name, $price, $data);

        if ($this->isSkuUnique($sku)) {
            $product->save($this->queryBuilder);
        } else {
            throw new Exception("SKU must be unique");
        }
    }

    private function isSkuUnique($sku) {
        $result = $this->queryBuilder->select('products', 'COUNT(*) as count', 'sku = "' . $sku . '"');
        return $result[0]['count'] == 0;
    }

    private function createProductInstance($type, $sku, $name, $price, $data) {
        switch ($type) {
            case 'DVD':
                return new DVD($sku, $name, $price, $data['size']);
            case 'Book':
                return new Book($sku, $name, $price, $data['weight']);
            case 'Furniture':
                return new Furniture($sku, $name, $price, $data['height'], $data['width'], $data['length']);
            default:
                throw new Exception("Invalid product type");
        }
    }
}
