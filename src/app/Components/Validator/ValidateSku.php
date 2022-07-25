<?php

namespace Components\Validator;

use Model\Domain\ProductRepositoryInterface;

class ValidateSku implements ValidateSkuInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param string $sku
     * @return bool
     */
    public function isSkuUnique(string $sku): bool
    {
        return $this->productRepository->existsBySKU($sku);
    }
}