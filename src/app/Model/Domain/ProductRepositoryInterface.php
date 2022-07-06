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
     * @param ProductIsUnique $productIsUnique
     * @return void
     */
    public function deleteBySKU(ProductIsUnique $productIsUnique): void;

    /**
     * @param string $sku
     * @return bool
     */
    public function existsBySKU(string $sku): bool;
}