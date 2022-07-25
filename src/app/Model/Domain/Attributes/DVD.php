<?php

namespace Model\Domain\Attributes;

use Exception;
use Model\Domain\{ProductRepositoryInterface, ProductSKU, ProductItem};

class DVD implements AttributeInterface
{
    /**
     * @var array
     */
    private $data;
    /**
     * @param array $post
     */
    public function __construct(array $post)
    {
        $this->data = $post;
    }


    /**
     * @param ProductItem $productItem
     * @param ProductSKU $productSKU
     * @param ProductRepositoryInterface $productRepository
     * @return void
     * @throws Exception
     */
    public function validate(
        ProductItem $productItem,
        ProductSKU $productSKU,
        ProductRepositoryInterface $productRepository
    ): void {
        $productItem->setSKU($productSKU, $productRepository);
        $productItem->setName($this->data['name']);
        $productItem->setPrice($this->data['price']);
        $productItem->setProductType($this->data['productType']);
        $productItem->setDVD($this->data['size']);
    }
    /**
     * @param $name
     * @return string
     */
    public function __get($name): string
    {
        return $this->data[$name];
    }
}