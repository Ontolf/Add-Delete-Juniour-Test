<?php include "layout/product_list_nav/title-product-list.php" ?>
<?php include "layout/head.php" ?>

<div class="page-container">
    <?php include "layout/header.php"?>
    <?php include "layout/product_list_nav/nav-product-list.php" ?>

    <main class="main-container">
        <form action="/mass-delete" method="post" id="delete-checkbox-form">

            <ul class="ul-list-style-none products-container">
                <?php
                // Autoload of Products from database
                foreach ($this->data["productCollection"] as $product) : ?>

                    <li class="product-card">
                        <input autocomplete="off" type="checkbox" name="checkboxMassDelete[]" value="<?=$product['sku']?>" onchange="checkProduct('<?=$product['sku']?>')" class="delete-checkbox">
                        <div><?=$product['sku']?></div>
                        <div><?=$product['name']?></div>
                        <div><?=$product['price']?> $</div>
                        <?php if ($product['size']):?>
                            <div>Size: <?=$product['size']?> MB</div>
                        <?php endif; ?>
                        <?php if ($product['weight']):?>
                            <div>Weight: <?=$product['weight']?>KG</div>
                        <?php endif; ?>
                        <?php if ($product['height']):?>
                            <div>Dimension: <?=$product['height']?>x<?=$product['width']?>x<?=$product['length']?></div>
                        <?php endif; ?>
                    </li>

                <?php endforeach; ?>
            </ul>

        </form>
    </main>

    <script src="/js/validate-mass-delete.js"></script>
</div>

<?php include "layout/footer.php" ?>