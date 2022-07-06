const getHtmlFormElementByID = (getHtmlFormElement: string) => <HTMLFormElement>document.getElementById(getHtmlFormElement)!;

const productForm: HTMLElement = document.getElementById("product_form")!;

async function SubmitForm()
{
    let productTypeValue: string = getHtmlFormElementByID("productType").value;

    let validator = new Validator();

    validator.holder(new IsRequired(getHtmlFormElementByID("sku").value, "Please, fill empty input.", "sku-error"));
    let response = await fetch('/product/check-sku');
    let data = await response.json();
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

    private checkIsRequired()
    {
        this.isValid = true;
        if(this.value.trim() === "") {
            this.isValid = false;
        }
    }

    public getError(): string {
        if (!this.isValid) {
            return this.error;
        }

        return "";
    }

    public getHtmlErrorHolderName(): string {
        if (!this.isValid) {
            return this.errorHolderName;
        }

        return "";
    }

    public resetHtmlError() {
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
    private sku_array: string[];

    public constructor(value: string, error: string, errorHolderName: string, sku_array: string[])
    {
        super(value, error, errorHolderName);
        this.sku_array = sku_array;

        if (this.value !== "") {
            this.resetHtmlError();
        }
        this.checkSkuUniqueness();
    }

    private checkSkuUniqueness(): void
    {
        this.isValid = true;
        for (let i = 0; i < this.sku_array.length; i++) {
            if(this.value.toUpperCase() === this.sku_array[i].toUpperCase()) {
                this.isValid = false;
            }
        }
    }
}

class Validator
{
    private errors: {errorMessage: string, htmlErrorHolderName: string}[] = [];

    public holder (temporaryClass: ValidatorInterface) {
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