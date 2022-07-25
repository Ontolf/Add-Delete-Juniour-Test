<?php

namespace Controllers;

use Model\Product;
use Model\Repository\ProductMysqlRepository;
use Model\Domain\{ProductItem, ProductSKU};
use Model\Domain\Attributes\{DVD, Book, Furniture};
use Components\Validator\{IsNumeric, IsRequired, IsSkuUnique, ValidateSku};

class SaveController extends Controller
{
    /**
     * @return void
     * @throws \Exception
     */
    public function execute(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header("location:/");
        }

        $productRepository = new ProductMysqlRepository($this->app->database());
        $validator = $this->app->validator();
        $validator->holder(new IsRequired("sku", "Please, submit required data", $this->data));
        $validator->holder(new IsSkuUnique("sku", "Please, provide unique SKU", $this->data["sku"], new ValidateSku($productRepository)));
        $validator->holder(new IsRequired("name", "Please, submit required data", $this->data));
        $validator->holder(new IsRequired("price", "Please, submit required data", $this->data));
        $validator->holder(new IsNumeric("price", "Price must be in the following format 0.00", $this->data));

        $attribute = null;
        if ($this->data['productType'] === "dvd") {
            $validator->holder(new IsRequired("size", "Please, submit required data", $this->data));
            $validator->holder(new IsNumeric("size", "Price must be in the following format 0.00", $this->data));
            $attribute = new DVD($this->data);
        }

        if ($this->data['productType'] === "book") {
            $validator->holder(new IsRequired("weight", "Please, submit required data", $this->data));
            $validator->holder(new IsNumeric("weight", "Price must be in the following format 0.00", $this->data));
            $attribute = new Book($this->data);
        }

        if ($this->data['productType'] === "furniture") {
            $validator->holder(new IsRequired("height", "Please, submit required data", $this->data));
            $validator->holder(new IsNumeric("height", "Price must be in the following format 0.00", $this->data));
            $validator->holder(new IsRequired("length", "Please, submit required data", $this->data));
            $validator->holder(new IsNumeric("length", "Price must be in the following format 0.00", $this->data));
            $validator->holder(new IsRequired("width", "Please, submit required data", $this->data));
            $validator->holder(new IsNumeric("width", "Price must be in the following format 0.00", $this->data));
            $attribute = new Furniture($this->data);
        }

        if ($validator->isValid() && $attribute) {
            $product = new Product(
                $productRepository,
                new ProductSKU((string)$this->data['sku'])
            );
            $product->saveProduct(new ProductItem, $attribute);
            header("location:/");
        } else {
            header("location:/add-product");
        }
    }
}