const DeleteCheckBoxForm = <HTMLFormElement>document.getElementById("delete-checkbox-form")!;

let productsToDelete: string[] = [];

function checkProduct(sku: string): void
{
    if (productsToDelete.find(el => el === sku)) {
        productsToDelete = productsToDelete.filter(el => el !== sku);
    } else {
        productsToDelete.push(sku);
    }
}

function SubmitFormDelete(): void
{
    DeleteCheckBoxForm.submit();
}

DeleteCheckBoxForm.addEventListener("submit", e => {
    e.preventDefault();

    // Check is there any product to delete
    if (productsToDelete.length !== 0) {
        DeleteCheckBoxForm.submit();
        location.href="/mass-delete";
    }
})