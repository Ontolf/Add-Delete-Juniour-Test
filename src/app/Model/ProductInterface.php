<?php

namespace Model;

use Model\Domain\{Attributes\AttributeInterface, ProductItem, ProductRepositoryInterface, ProductSKU};

interface ProductInterface
{
    /**
     * @param ProductRepositoryInterface $productRepository
     * @param ProductSKU $productSKU
     */
    public function __construct(ProductRepositoryInterface $productRepository, ProductSKU $productSKU);

    /**
     * @param ProductItem $productToSave
     * @param AttributeInterface $attribute
     * @return void
     */
    public function saveProduct(ProductItem $productToSave, AttributeInterface $attribute): void;
}