<?php

namespace Controllers;

use Model\Domain\ProductIsUnique;
use Model\Product;
use Model\Domain\ProductSKU;
use Model\Repository\ProductMysqlRepository;
use Components\IsRequired;

class DeleteController extends Controller
{
    /**
     * @return void
     * @throws \Exception
     */
    public function execute(): void
    {
        foreach ($this->data['checkboxMassDelete'] as $key=>$product) {
            $this->app->validator()->holder(new IsRequired($key, "", $this->data['checkboxMassDelete']));
        }

        if ($this->app->validator()->isValid()) {
            foreach ($this->data['checkboxMassDelete'] as $sku) {
                $productRepository = new ProductMysqlRepository($this->app->database());
                $product = new Product($productRepository);
                $product->deleteBySku(new ProductIsUnique(new ProductSKU($sku), $productRepository));
            }
        }

        header("location:/");
    }
}