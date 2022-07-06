<?php

namespace Controllers;

class CheckSkuController extends Controller
{
    /**
     * @return string
     */
    public function execute(): string
    {
        $skus = $this->app->database()->query('SELECT sku FROM products');
        $sku_array = [];
        foreach ($skus as $sku) {
            $sku_array[] = $sku['sku'];
        }
        header('Content-Type: application/json');
        return json_encode($sku_array);
    }
}