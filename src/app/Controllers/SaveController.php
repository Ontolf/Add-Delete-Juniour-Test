<?php

namespace Controllers;

use Model\Domain\ProductItem;
use Model\Product;
use Model\Repository\ProductMysqlRepository;
use Components\{IsNumeric, IsRequired, IsSkuUnique, ValidateSku};

class SaveController extends Controller
{
    /**
     * @return void
     * @throws \Exception
     */
    public function execute(): void
    {
        $this->app->validator()->holder(new IsRequired("sku", "Please, submit required data", $this->data));
        $this->app->validator()->holder(new IsSkuUnique("sku", "Please, provide unique SKU", $this->data["sku"], new ValidateSku($this->app->database())));
        $this->app->validator()->holder(new IsRequired("name", "Please, submit required data", $this->data));
        $this->app->validator()->holder(new IsRequired("price", "Please, submit required data", $this->data));
        $this->app->validator()->holder(new IsNumeric("price", "Price must be in the following format 0.00", $this->data));

        if ($this->data['productType'] === "dvd") {
            $this->app->validator()->holder(new IsRequired("size", "Please, submit required data", $this->data));
            $this->app->validator()->holder(new IsNumeric("size", "Price must be in the following format 0.00", $this->data));
        }

        if ($this->data['productType'] === "book") {
            $this->app->validator()->holder(new IsRequired("weight", "Please, submit required data", $this->data));
            $this->app->validator()->holder(new IsNumeric("weight", "Price must be in the following format 0.00", $this->data));
        }

        if ($this->data['productType'] === "furniture") {
            $this->app->validator()->holder(new IsRequired("height", "Please, submit required data", $this->data));
            $this->app->validator()->holder(new IsNumeric("height", "Price must be in the following format 0.00", $this->data));
            $this->app->validator()->holder(new IsRequired("length", "Please, submit required data", $this->data));
            $this->app->validator()->holder(new IsNumeric("length", "Price must be in the following format 0.00", $this->data));
            $this->app->validator()->holder(new IsRequired("width", "Please, submit required data", $this->data));
            $this->app->validator()->holder(new IsNumeric("width", "Price must be in the following format 0.00", $this->data));
        }

        if ($this->app->validator()->isValid()) {
            $product = new Product(
                new ProductMysqlRepository($this->app->database()),
                (string)$this->data['sku'],
                (string)$this->data['name'],
                (float)$this->data['price'],
                (float)$this->data['size'],
                (float)$this->data['weight'],
                (float)$this->data['height'],
                (float)$this->data['length'],
                (float)$this->data['width'],
                (string)$this->data['productType']
            );
            $product->saveProduct(new ProductItem);
            header("location:/");
        } else {
            header("location:/product-add");
        }
    }
}