<?php

namespace Model\Domain;

use Exception;

class ProductSKU
{
    /**
     * @var
     */
    private $sku;

    /**
     * @param string $sku
     * @throws \Exception
     */
    public function __construct(string $sku)
    {
        $this->checkSku($sku);
    }

    /**
     * @param string $sku
     * @return void
     * @throws Exception
     */
    private function checkSku(string $sku): void
    {
        if ($sku === "") {
            throw new Exception("Empty element sku was provided!");
        }

        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }
}