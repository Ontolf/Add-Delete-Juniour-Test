"use strict";
const DeleteCheckBoxElement = document.getElementById("delete-checkbox-form");
const DeleteCheckBoxForm = document.getElementById("delete-checkbox-form");
let productsToDelete = [];
function checkProduct(sku) {
    if (productsToDelete.find(el => el === sku)) {
        productsToDelete = productsToDelete.filter(el => el !== sku);
    }
    else {
        productsToDelete.push(sku);
    }
}
function SubmitFormDelete() {
    DeleteCheckBoxElement.dispatchEvent(new Event("submit", { cancelable: true }));
}
DeleteCheckBoxElement.addEventListener("submit", e => {
    e.preventDefault();
    // Check is there any product to delete
    if (productsToDelete.length !== 0) {
        DeleteCheckBoxForm.submit();
        location.href = "/mass-delete";
    }
});
//# sourceMappingURL=validate-mass-delete.js.map