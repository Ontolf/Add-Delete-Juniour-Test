const DeleteCheckBoxElement = <HTMLElement>document.getElementById("delete-checkbox-form")!;
const DeleteCheckBoxForm = <HTMLFormElement>document.getElementById("delete-checkbox-form")!;

let productsToDelete: string[] = [];

function checkProduct(sku: string)
{
    if (productsToDelete.find(el => el === sku)) {
        productsToDelete = productsToDelete.filter(el => el !== sku);
    } else {
        productsToDelete.push(sku);
    }
}

function SubmitFormDelete(): void
{
    DeleteCheckBoxElement.dispatchEvent(new Event("submit", { cancelable: true }));
}

DeleteCheckBoxElement.addEventListener("submit", e => {
    e.preventDefault();

    // Check is there any product to delete
    if (productsToDelete.length !== 0) {
        DeleteCheckBoxForm.submit();
        location.href="/mass-delete";
    }
})