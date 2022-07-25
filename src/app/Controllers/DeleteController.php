<?php

namespace Controllers;

use Model\Domain\{ProductSKU, ProductIsUnique};
use Model\Repository\ProductMysqlRepository;
use Components\Validator\IsRequired;

class DeleteController extends Controller
{
    /**
     * @return void
     * @throws \Exception
     */
    public function execute(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validator = $this->app->validator();
            foreach ($this->data['checkboxMassDelete'] as $key=>$product) {
                $validator->holder(new IsRequired($key, "", $this->data['checkboxMassDelete']));
            }

            if ($validator->isValid()) {
                foreach ($this->data['checkboxMassDelete'] as $sku) {
                    $productSKU = new ProductSKU($sku);

                    $productRepository = new ProductMysqlRepository($this->app->database());
                    new ProductIsUnique($productSKU, $productRepository);

                    $productRepository->deleteBySku($productSKU);
                }
            }
        }

        header("location:/");
    }
}