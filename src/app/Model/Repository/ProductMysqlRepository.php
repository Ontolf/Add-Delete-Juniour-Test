<?php

namespace Model\Repository;

use Model\Domain\{ProductIsUnique, ProductItem, ProductRepositoryInterface, ProductSKU};

class ProductMysqlRepository implements ProductRepositoryInterface
{
    /**
     * @var \PDO
     */
    private $database;

    /**
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->database = $pdo;
    }

    /**
     * @description Insert into the database
     * @param ProductItem $productItem
     * @return void
     */
    public function save(ProductItem $productItem): void
    {
        $product = $this->database->prepare("
            INSERT INTO products 
            ( sku, name, price, size, weight, height, length, width, productType)
            VALUE
            (:sku, :name, :price, :size, :weight, :height, :length, :width, :productType)
            ");

        $product->execute([
            ':sku' => $productItem->sku,
            ':name' => $productItem->name,
            ':price' => $productItem->price,
            ':size' => $productItem->size,
            ':weight' => $productItem->weight,
            ':height' => $productItem->height,
            ':length' => $productItem->length,
            ':width' => $productItem->width,
            ':productType' => $productItem->productType
        ]);
    }

    /**
     * @description Delete from the database
     * @param ProductIsUnique $productIsUnique
     * @return void
     */
    public function deleteBySKU(ProductIsUnique $productIsUnique): void
    {
        $sku = $productIsUnique->getSku();
        $productToDelete = $this->database->prepare("DELETE FROM products WHERE (sku) = (:sku)");
        $productToDelete->execute([':sku'=>$sku]);
    }

    /**
     * @description Check on same sku in the database
     * @param string $sku
     * @return bool
     */
    public function existsBySKU(string $sku): bool
    {
        $query = $this->database->prepare('SELECT sku FROM products WHERE sku = :sku');
        $query->execute(["sku" => $sku]);
        $product = $query->fetch();

        return !empty($product);
    }
}