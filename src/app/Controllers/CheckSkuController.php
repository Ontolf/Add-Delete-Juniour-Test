<?php

namespace Controllers;

use Components\Validator\IsSkuUnique;
use Components\Validator\ValidateSku;
use Model\Repository\ProductMysqlRepository;

class CheckSkuController extends Controller
{
    /**
     * @return string
     */
    public function execute(): string
    {
        $isSkuUnique = false;
        if ($_POST) {
            $sku = json_decode(file_get_contents("php://input"));
            $productMysqlRepository = $this->app->repository(ProductMysqlRepository::class);
            $isSkuUnique = !$productMysqlRepository->existsBySKU($sku);
        }
        header('Content-Type: application/json');
        return json_encode($isSkuUnique);
    }
}