<?php

namespace Model\Domain;

use Exception;

class ProductIsUnique
{
    /**
     * @var ProductSKU
     */
    private $productSKU;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @param ProductSKU $productSKU
     * @param ProductRepositoryInterface $productRepository
     * @throws Exception
     */
    public function __construct(ProductSKU $productSKU, ProductRepositoryInterface $productRepository)
    {
        $this->productSKU = $productSKU;
        $this->productRepository = $productRepository;

        $this->checkUniqueness();
    }

    /**
     * @return void
     * @throws Exception
     */
    private function checkUniqueness(): void
    {
        if (!$this->productRepository->existsBySKU($this->productSKU->getSku()))
        {
            throw new Exception("Please, provide unique sku!");
        }
    }
}