<?php

namespace Model;

use Model\Domain\{ProductItem, ProductRepositoryInterface, ProductSKU};
use Model\Domain\Attributes\{AttributeInterface};

class Product implements ProductInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var ProductSKU
     */
    private $productSKU;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param ProductSKU $productSKU
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductSKU $productSKU
    ) {
        $this->productRepository = $productRepository;
        $this->productSKU = $productSKU;
    }

    /**
     * @param ProductItem $productItem
     * @param AttributeInterface $attribute
     * @return void
     */
    public function saveProduct(ProductItem $productItem, AttributeInterface $attribute): void
    {
        $attribute->validate($productItem, $this->productSKU, $this->productRepository);
        $this->productRepository->save($productItem);
    }
}
