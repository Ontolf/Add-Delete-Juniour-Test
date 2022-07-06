<?php

return [
    ["url" => "/", "type" => "callback", "segments" =>
        function(DependencyContainer $app)
        {
            $products = $app->database()->query('SELECT * FROM products');
            return $app->template("templates/product-list.php",["productCollection" => $products])->render();
        }],
    ["url" => "/product-add", "type" => "callback", "segments" =>
        function(DependencyContainer $app)
        {
            $validator = $app->validator();
            return $app->template("templates/product-add.php", ["validatorCollection" => $validator])->render();
        }],
    ["url" => "/confirmation", "type" => "controller", "segments" => "SaveController"],
    ["url" => "/mass-delete", "type" => "controller", "segments" => "DeleteController"],
    ["url" => "/product/check-sku", "type" => "controller", "segments" => "CheckSkuController"]
];