<?php include "layout/product_add_nav/title-product-add.php"?>
<?php include "layout/head.php" ?>
<div class="page-container">
    <?php include "layout/header.php" ?>
    <?php include "layout/product_add_nav/nav-product-add.php" ?>

    <main class="main-container">
        <form action="/confirmation" method="post" id="product_form" class="product-form">

            <div class="form-item">
                <label for="sku">SKU</label><input type="text" name="sku" id="sku" >
            </div>
            <div class="error" id="sku-error"><?= $this->data["validatorCollection"]->flashMessage("sku") ?></div>

            <div class="form-item">
                <label for="name">Name</label><input type="text" name="name" id="name" >
            </div>
            <div class="error" id="name-error"><?= $this->data["validatorCollection"]->flashMessage("name") ?></div>

            <div class="form-item">
                <label for="price">Price ($)</label><input type="text" name="price" id="price" >
            </div>
            <div class="error" id="price-error"><?= $this->data["validatorCollection"]->flashMessage("price") ?></div>

            <div class="form-item" id="type_switcher_holder">
                <label for="productType">Type Switcher</label>
                <select class="product-type-select" name="productType" id="productType">
                    <option value="dvd">DVD</option>
                    <option value="book">Book</option>
                    <option value="furniture">Furniture</option>
                </select>
            </div>

            <div class="switcher-input-container" id="switcher-input-container-type-furniture">
                <div class="form-item">
                    <label for="height">Height (CM)</label><input type="text" name="height" id="height" >
                </div>
                <div class="error" id="height-error"><?= $this->data["validatorCollection"]->flashMessage("height") ?></div>

                <div class="form-item">
                    <label for="width">Width (CM)</label><input type="text" name="width" id="width">
                </div>
                <div class="error" id="width-error"><?= $this->data["validatorCollection"]->flashMessage("width") ?></div>

                <div class="form-item">
                    <label for="length">Length (CM)</label><input type="text" name="length" id="length">
                </div>
                <div class="error" id="length-error"><?= $this->data["validatorCollection"]->flashMessage("length") ?></div>
                <p class="description-for-form-input">Please provide dimensions in HxWxL format</p>
            </div>

            <div class="switcher-input-container" id="switcher-input-container-type-book">
                <div class="form-item">
                    <label for="weight">Weight (KG)</label><input type="text" name="weight" id="weight">
                </div>
                <div class="error" id="weight-error"><?= $this->data["validatorCollection"]->flashMessage("weight") ?></div>
                <p class="description-for-form-input">Please provide weight in kg format</p>
            </div>

            <div class="switcher-input-container" id="switcher-input-container-type-dvd">
                <div class="form-item">
                    <label for="size">Size (MB)</label><input type="text" name="size" id="size">
                </div>
                <div class="error" id="size-error"><?= $this->data["validatorCollection"]->flashMessage("size") ?></div>
                <p class="description-for-form-input">Please provide size in MB format</p>
            </div>

        </form>
    </main>

    <script src="/js/type-switcher.js"></script>
    <script src="/js/form-validator.js"></script>

</div>

<?php include "layout/footer.php" ?>