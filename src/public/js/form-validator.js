"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
const getHtmlFormElementByID = (getHtmlFormElement) => document.getElementById(getHtmlFormElement);
const productForm = document.getElementById("product_form");
function isSkuUnique(sku) {
    return __awaiter(this, void 0, void 0, function* () {
        if (sku !== "") {
            const jsonSku = JSON.stringify(sku);
            let response = yield fetch('/product/check-sku', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded', },
                body: jsonSku,
            });
            return yield response.json();
        }
        return true;
    });
}
function SubmitForm() {
    return __awaiter(this, void 0, void 0, function* () {
        let productTypeValue = getHtmlFormElementByID("productType").value;
        let validator = new Validator();
        let sku = getHtmlFormElementByID("sku").value;
        validator.holder(new IsRequired(sku, "Please, fill empty input.", "sku-error"));
        let isUnique = yield isSkuUnique(sku);
        validator.holder(new IsSkuUnique(sku, "Please, provide unique SKU.", "sku-error", isUnique));
        validator.holder(new IsRequired(getHtmlFormElementByID("name").value, "Please, fill empty input.", "name-error"));
        let price = getHtmlFormElementByID("price").value;
        validator.holder(new IsRequired(price, "Please, fill empty input.", "price-error"));
        validator.holder(new IsNumeric(price, "Please, provide data of indicated type.", "price-error"));
        if (productTypeValue === "book") {
            let weight = getHtmlFormElementByID("weight").value;
            validator.holder(new IsRequired(weight, "Please, fill empty input.", "weight-error"));
            validator.holder(new IsNumeric(weight, "Please, data of indicated type.", "weight-error"));
        }
        if (productTypeValue === "dvd") {
            let size = getHtmlFormElementByID("size").value;
            validator.holder(new IsRequired(size, "Please, fill empty input.", "size-error"));
            validator.holder(new IsNumeric(size, "Please, provide data of indicated type.", "size-error"));
        }
        if (productTypeValue === "furniture") {
            let height = getHtmlFormElementByID("height").value;
            let length = getHtmlFormElementByID("length").value;
            let width = getHtmlFormElementByID("width").value;
            validator.holder(new IsRequired(height, "Please, fill empty input.", "height-error"));
            validator.holder(new IsNumeric(height, "Please, provide data of indicated type.", "height-error"));
            validator.holder(new IsRequired(length, "Please, fill empty input.", "length-error"));
            validator.holder(new IsNumeric(length, "Please, provide data of indicated type.", "length-error"));
            validator.holder(new IsRequired(width, "Please, fill empty input.", "width-error"));
            validator.holder(new IsNumeric(width, "Please, provide data of indicated type.", "width-error"));
        }
        if (validator.isValid()) {
            productForm.submit();
        }
        else {
            validator.setErrors();
        }
    });
}
class IsRequired {
    constructor(value, error, errorHolderName) {
        this.isValid = true;
        this.value = value;
        this.error = error;
        this.errorHolderName = errorHolderName;
        this.resetHtmlError();
        this.checkIsRequired();
    }
    checkIsRequired() {
        this.isValid = true;
        if (this.value.trim() === "") {
            this.isValid = false;
        }
    }
    getError() {
        if (!this.isValid) {
            return this.error;
        }
        return "";
    }
    getHtmlErrorHolderName() {
        if (!this.isValid) {
            return this.errorHolderName;
        }
        return "";
    }
    resetHtmlError() {
        document.getElementById(this.errorHolderName).innerHTML = "";
    }
}
class IsNumeric extends IsRequired {
    constructor(value, error, errorHolderName) {
        super(value, error, errorHolderName);
        this.resetHtmlError();
        this.checkIsNumeric();
    }
    checkIsNumeric() {
        const TEST_CHARS = /^(\d+[.])?\d+$/;
        this.isValid = true;
        if (!TEST_CHARS.test(this.value) && !(this.value.trim() === "")) {
            this.isValid = false;
        }
    }
}
class IsSkuUnique extends IsRequired {
    constructor(value, error, errorHolderName, isSkuUnique) {
        super(value, error, errorHolderName);
        this.isValid = isSkuUnique;
        if (this.value !== "") {
            this.resetHtmlError();
        }
    }
}
class Validator {
    constructor() {
        this.errors = [];
    }
    holder(temporaryClass) {
        let obj = { errorMessage: temporaryClass.getError(), htmlErrorHolderName: temporaryClass.getHtmlErrorHolderName() };
        if (obj.errorMessage !== "") {
            this.errors.push(obj);
        }
    }
    isValid() {
        if (this.errors.length === 0) {
            return true;
        }
        return false;
    }
    setErrors() {
        for (let i = 0; i < this.errors.length; i++) {
            document.getElementById(this.errors[i].htmlErrorHolderName).innerHTML = this.errors[i].errorMessage;
        }
    }
}
//# sourceMappingURL=form-validator.js.map