<?php

namespace Model\Domain;

interface ProductRepositoryInterface
{
    /**
     * @param ProductItem $productItem
     * @return void
     */
    public function save(ProductItem $productItem): void;

    /**
     * @param ProductSKU $productSKU
     * @return void
     */
    public function deleteBySKU(ProductSKU $productSKU): void;

    /**
     * @param string $sku
     * @return bool
     */
    public function existsBySKU(string $sku): bool;
}