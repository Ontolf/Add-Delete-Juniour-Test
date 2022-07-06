<?php

namespace Model;

use Model\Domain\{ProductIsUnique, ProductItem, ProductRepositoryInterface};

interface ProductInterface
{
    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository);

    /**
     * @param ProductItem $productToSave
     * @return void
     */
    public function saveProduct(ProductItem $productToSave): void;

    /**
     * @param ProductIsUnique $productIsUnique
     * @return void
     */
    public function deleteBySku(ProductIsUnique $productIsUnique): void;
}