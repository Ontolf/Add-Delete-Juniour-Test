const getHtmlFormElementByID = (getHtmlFormElement: string) => <HTMLFormElement>document.getElementById(getHtmlFormElement)!;

const productForm = <HTMLFormElement>document.getElementById("product_form")!;

async function isSkuUnique(sku: string)
{
    if (sku !== "") {
        const jsonSku = JSON.stringify(sku);
        let response = await fetch('/product/check-sku', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded',},
            body: jsonSku,
        });
        return await response.json();
    }
    return true;
}

async function SubmitForm()
{
    let productTypeValue: string = getHtmlFormElementByID("productType").value;

    let validator = new Validator();
    let sku = getHtmlFormElementByID("sku").value;
    validator.holder(new IsRequired(sku, "Please, fill empty input.", "sku-error"));
    let isUnique: boolean = await  isSkuUnique(sku);
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
    } else {
        validator.setErrors();
    }
}

interface ValidatorInterface
{
    getError(): string;
    getHtmlErrorHolderName(): string;
    resetHtmlError(): void;
}

class IsRequired implements ValidatorInterface
{
    protected readonly value: string;
    protected readonly error: string;
    protected readonly errorHolderName: string;
    protected isValid: boolean = true;

    public constructor(value: string, error: string, errorHolderName: string)
    {
        this.value = value;
        this.error = error;
        this.errorHolderName = errorHolderName;

        this.resetHtmlError();
        this.checkIsRequired();
    }

    private checkIsRequired(): void
    {
        this.isValid = true;
        if (this.value.trim() === "") {
            this.isValid = false;
        }
    }

    public getError(): string
    {
        if (!this.isValid) {
            return this.error;
        }

        return "";
    }

    public getHtmlErrorHolderName(): string
    {
        if (!this.isValid) {
            return this.errorHolderName;
        }

        return "";
    }

    public resetHtmlError(): void
    {
        (<HTMLElement>document.getElementById(this.errorHolderName)!).innerHTML = "";
    }
}

class IsNumeric extends IsRequired implements ValidatorInterface
{
    public constructor(value: string, error: string, errorHolderName: string)
    {
        super(value, error, errorHolderName);

        this.resetHtmlError();
        this.checkIsNumeric();
    }

    private checkIsNumeric(): void
    {
        const TEST_CHARS = /^(\d+[.])?\d+$/;
        this.isValid = true;
        if (!TEST_CHARS.test(this.value) && !(this.value.trim() === "")) {
            this.isValid = false;
        }
    }
}

class IsSkuUnique extends IsRequired implements ValidatorInterface
{
    public constructor(value: string, error: string, errorHolderName: string, isSkuUnique: boolean)
    {
        super(value, error, errorHolderName);
        this.isValid = isSkuUnique;
        if (this.value !== "") {
            this.resetHtmlError();
        }
    }
}

class Validator
{
    private errors: {errorMessage: string, htmlErrorHolderName: string}[] = [];

    public holder (temporaryClass: ValidatorInterface): void
    {
        let obj = {errorMessage: temporaryClass.getError(), htmlErrorHolderName: temporaryClass.getHtmlErrorHolderName()};
        if (obj.errorMessage !== ""){
            this.errors.push(obj);
        }
    }

    public isValid(): boolean
    {
        if (this.errors.length === 0) {
            return true;
        }

        return false;
    }

    public setErrors(): void
    {
        for (let i = 0; i < this.errors.length; i++) {
            (<HTMLElement>document.getElementById(this.errors[i].htmlErrorHolderName)!).innerHTML = this.errors[i].errorMessage;
        }
    }
}