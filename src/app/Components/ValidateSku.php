<?php

namespace Components;

class ValidateSku implements ValidateSkuInterface
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
     * @param string $sku
     * @return bool
     */
    public function isSkuUnique(string $sku): bool
    {
        $query = $this->database->prepare('SELECT sku FROM products WHERE sku = :sku');
        $query->execute([':sku' => $sku]);
        $product = $query->fetch();

        return empty($product);
    }
}