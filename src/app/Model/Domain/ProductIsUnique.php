<?php

namespace Model\Domain;
use Model\Repository\ProductMysqlRepository;

class ProductIsUnique
{
    /**
     * @var ProductSKU
     */
    private $productSKU;
    /**
     * @var ProductMysqlRepository
     */
    private $productMysqlRepository;

    /**
     * @param ProductSKU $productSKU
     * @param ProductMysqlRepository $productMysqlRepository
     * @throws \Exception
     */
    public function __construct(ProductSKU $productSKU, ProductMysqlRepository $productMysqlRepository)
    {
        $this->productSKU = $productSKU;
        $this->productMysqlRepository = $productMysqlRepository;

        $this->checkUniqueness();
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function checkUniqueness(): void
    {
        if (!$this->productMysqlRepository->existsBySKU($this->productSKU->getSku()))
        {
            throw new \Exception("Not unique sku was provided!");
        }
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->productSKU->getSku();
    }
}