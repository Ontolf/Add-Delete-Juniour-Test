<?php

namespace Model\Domain\Attributes;

use Model\Domain\ProductItem;
use Model\Domain\ProductRepositoryInterface;
use Model\Domain\ProductSKU;

interface AttributeInterface
{
    /**
     * @param array $post
     */
    public function __construct(array $post);

    /**
     * @param ProductItem $productItem
     * @param ProductSKU $productSKU
     * @param ProductRepositoryInterface $productRepository
     * @return void
     */
    public function validate(
        ProductItem $productItem,
        ProductSKU $productSKU,
        ProductRepositoryInterface $productRepository
    ): void;

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name): string;
}