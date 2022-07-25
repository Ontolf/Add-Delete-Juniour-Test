<?php

namespace Components\Validator;

use Model\Domain\ProductRepositoryInterface;

interface ValidateSkuInterface
{
    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository);

    /**
     * @param string $sku
     * @return bool
     */
    public function isSkuUnique(string $sku): bool;
}
