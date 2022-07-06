<?php

namespace Model;

use Model\Domain\{ProductIsUnique, ProductItem, ProductRepositoryInterface, ProductSKU};

class Product implements ProductInterface
{
    /**
     * @var string|NULL
     */
    private $sku;
    /**
     * @var string|NULL
     */
    private $name;
    /**
     * @var float|NULL
     */
    private $price;
    /**
     * @var float|NULL
     */
    private $size;
    /**
     * @var float|NULL
     */
    private $weight;
    /**
     * @var float|NULL
     */
    private $height;
    /**
     * @var float|NULL
     */
    private $length;
    /**
     * @var float|NULL
     */
    private $width;
    /**
     * @var string|NULL
     */
    private $productType;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepositoryInterface;

    /**
     * @param string|NULL $sku
     * @param string|NULL $name
     * @param float|NULL $price
     * @param float|NULL $size
     * @param float|NULL $weight
     * @param float|NULL $height
     * @param float|NULL $length
     * @param float|NULL $width
     * @param string|NULL $productType
     */
    public function __construct(
        ProductRepositoryInterface $productRepositoryInterface,
        string $sku = NULL,
        string $name = NULL,
        float $price = NULL,
        float $size = NULL,
        float $weight = NULL,
        float $height = NULL,
        float $length = NULL,
        float $width = NULL,
        string $productType = NULL
    ) {
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->size = $size;
        $this->weight = $weight;
        $this->height = $height;
        $this->length = $length;
        $this->width = $width;
        $this->productType = $productType;
    }


    /**
     * @param ProductItem $productItem
     * @return void
     * @throws \Exception
     */
    public function saveProduct(ProductItem $productItem): void
    {
        $productItem->setSKU($this->sku, $this->productRepositoryInterface);
        $productItem->setName($this->name);
        $productItem->setPrice($this->price);
        $productItem->setProductType($this->productType);

        if ($this->productType === 'dvd') {
            $productItem->setDVD($this->size);
        }

        if ($this->productType === 'book') {
            $productItem->setBook($this->weight);
        }

        if ($this->productType === 'furniture') {
            $productItem->setFurniture($this->height, $this->length, $this->width);
        }

        $this->productRepositoryInterface->save($productItem);
    }


    /**
     * @param ProductIsUnique $productIsUnique
     * @return void
     * @throws \Exception
     */
    public function deleteBySku(ProductIsUnique $productIsUnique): void
    {
        $this->productRepositoryInterface->deleteBySKU($productIsUnique);
    }
}
