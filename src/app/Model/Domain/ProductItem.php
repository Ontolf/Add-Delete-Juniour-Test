<?php

namespace Model\Domain;

use Exception;

/**
 * @property-read string $sku
 * @property-read string $name
 * @property-read float $price
 * @property-read float $size
 * @property-read float $weight
 * @property-read float $height
 * @property-read float $length
 * @property-read float $width
 * @property-read string $productType
 */
class ProductItem
{
    /**
     * @var string
     */
    private $sku;
    /**
     * @var string
     */
    private $name;
    /**
     * @var float
     */
    private $price;
    /**
     * @var float
     */
    private $size;
    /**
     * @var float
     */
    private $weight;
    /**
     * @var float
     */
    private $height;
    /**
     * @var float
     */
    private $length;
    /**
     * @var float
     */
    private $width;
    /**
     * @var string
     */
    private $productType;

    /**
     * @param ProductSKU $productSKU
     * @param ProductRepositoryInterface $ProductRepositoryInterface
     * @return void
     * @throws Exception
     */
    public function setSKU(
        ProductSKU $productSKU,
        ProductRepositoryInterface $ProductRepositoryInterface
    ): void {
        $sku = $productSKU->getSku();

        if ($sku === "") {
            throw new Exception("Invalid sku!");
        }

        if ($ProductRepositoryInterface->existsBySKU($sku)) {
            throw new Exception("Same sku was provided!");
        }

        $this->sku = $sku;
    }

    /**
     * @description Check name with Exception and after set it
     * @param string $name
     * @return void
     * @throws Exception
     */
    public function setName(string $name): void
    {
        if ($name === "") {
            throw new Exception("Invalid Name was provided!");
        }

        $this->name = $name;
    }

    /**
     * @description Check price with Exception and after set it
     * @param float $price
     * @return void
     * @throws Exception
     */
    public function setPrice(float $price): void
    {
        if (!is_float($price)) {
            throw new Exception("Invalid price was provided!");
        }

        $this->price = $price;
    }

    /**
     * @description Check DVDs parameters with Exception and after set them
     * @param float $size
     * @return void
     * @throws Exception
     */
    public function setDVD(float $size): void
    {
        if (!is_float($size)) {
            throw new Exception("Invalid size was provided!");
        }

        $this->size = $size;
    }

    /**
     * @description Check Book's parameters with Exception and after set them
     * @param float $weight
     * @return void
     * @throws Exception
     */
    public function setBook(float $weight): void
    {
        if (!is_float($weight)) {
            throw new Exception("Invalid weight was provided!");
        }

        $this->weight = $weight;
    }

    /**
     * @description Check Furniture's parameters with Exception and after set them
     * @param float $height
     * @param float $length
     * @param float $width
     * @return void
     * @throws Exception
     */
    public function setFurniture(float $height, float $length, float $width): void
    {
        if (
            !is_float($height)  ||
            !is_float($length)  ||
            !is_float($width)
        ) {
            throw new Exception("Invalid height, length, width was provided!");
        }

        $this->height = $height;
        $this->length = $length;
        $this->width = $width;
    }

    /**
     * @description Check productType with Exception and after set it
     * @param string $productType
     * @return void
     * @throws Exception
     */
    public function setProductType(string $productType): void
    {
        if ($productType === "") {
            throw new Exception("Invalid productType was provided!");
        }

        $this->productType = $productType;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }
}