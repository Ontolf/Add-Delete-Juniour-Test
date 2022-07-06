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
function SubmitForm() {
    return __awaiter(this, void 0, void 0, function* () {
        let productTypeValue = getHtmlFormElementByID("productType").value;
        let validator = new Validator();
        validator.holder(new IsRequired(getHtmlFormElementByID("sku").value, "Please, fill empty input.", "sku-error"));
        let response = yield fetch('/product/check-sku');
        let data = yield response.json();
        validator.holder(new IsSkuUnique(getHtmlFormElementByID("sku").value, "Please, provide unique SKU.", "sku-error", data));
        validator.holder(new IsRequired(getHtmlFormElementByID("name").value, "Please, fill empty input.", "name-error"));
        validator.holder(new IsRequired(getHtmlFormElementByID("price").value, "Please, fill empty input.", "price-error"));
        validator.holder(new IsNumeric(getHtmlFormElementByID("price").value, "Please, provide data of indicated type.", "price-error"));
        if (productTypeValue === "book") {
            validator.holder(new IsRequired(getHtmlFormElementByID("weight").value, "Please, fill empty input.", "weight-error"));
            validator.holder(new IsNumeric(getHtmlFormElementByID("weight").value, "Please, data of indicated type.", "weight-error"));
        }
        if (productTypeValue === "dvd") {
            validator.holder(new IsRequired(getHtmlFormElementByID("size").value, "Please, fill empty input.", "size-error"));
            validator.holder(new IsNumeric(getHtmlFormElementByID("size").value, "Please, provide data of indicated type.", "size-error"));
        }
        if (productTypeValue === "furniture") {
            validator.holder(new IsRequired(getHtmlFormElementByID("height").value, "Please, fill empty input.", "height-error"));
            validator.holder(new IsNumeric(getHtmlFormElementByID("height").value, "Please, provide data of indicated type.", "height-error"));
            validator.holder(new IsRequired(getHtmlFormElementByID("length").value, "Please, fill empty input.", "length-error"));
            validator.holder(new IsNumeric(getHtmlFormElementByID("length").value, "Please, provide data of indicated type.", "length-error"));
            validator.holder(new IsRequired(getHtmlFormElementByID("width").value, "Please, fill empty input.", "width-error"));
            validator.holder(new IsNumeric(getHtmlFormElementByID("width").value, "Please, provide data of indicated type.", "width-error"));
        }
        if (validator.isValid()) {
            productForm.dispatchEvent(new Event('submit'));
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
    constructor(value, error, errorHolderName, sku_array) {
        super(value, error, errorHolderName);
        this.sku_array = sku_array;
        if (this.value !== "") {
            this.resetHtmlError();
        }
        this.checkSkuUniqueness();
    }
    checkSkuUniqueness() {
        this.isValid = true;
        for (let i = 0; i < this.sku_array.length; i++) {
            if (this.value.toUpperCase() === this.sku_array[i].toUpperCase()) {
                this.isValid = false;
            }
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