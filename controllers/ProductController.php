<?php

class ProductController {
    private $queryBuilder;

    public function __construct($queryBuilder) {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Get all products from the database.
     *
     * @return array The list of products.
     */
    public function getAllProducts() {
        return $this->queryBuilder->select('products');
    }

    /**
     * Delete products from the database based on SKUs.
     *
     * @param array|string $skus The SKUs of the products to delete.
     * @return bool True on success, false on failure.
     */
    public function deleteProducts($skus) {
        if (!is_array($skus)) {
            $skus = [$skus];
        }
        return $this->queryBuilder->delete('products', $skus);
    }
}

?>
