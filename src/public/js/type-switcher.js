"use strict";
const switcherContainer = document.getElementById('productType');
const switcherInputValue = document.getElementById('productType');
const TypeContainer = {
    dvdType: document.getElementById('switcher-input-container-type-dvd'),
    bookType: document.getElementById('switcher-input-container-type-book'),
    furnitureType: document.getElementById('switcher-input-container-type-furniture'),
};
class Switcher {
    constructor(elements) {
        this.elements = elements;
        this.hideAllElements();
    }
    hideAllElements() {
        for (let x = 0; x < this.elements.length; x++) {
            this.elements[x].style.display = "none";
        }
    }
    showElement(element) {
        this.hideAllElements();
        element.style.display = "";
    }
}
const TypeArray = [TypeContainer.dvdType, TypeContainer.bookType, TypeContainer.furnitureType];
const switcher = new Switcher(TypeArray);
switcherContainer.addEventListener("change", function () {
    if (switcherInputValue.value === "dvd") {
        switcher.showElement(TypeContainer.dvdType);
    }
    if (switcherInputValue.value === "book") {
        switcher.showElement(TypeContainer.bookType);
    }
    if (switcherInputValue.value === "furniture") {
        switcher.showElement(TypeContainer.furnitureType);
    }
});
// Trigger the change event to load the initial input field DVD
switcherContainer.dispatchEvent(new Event('change'));
//# sourceMappingURL=type-switcher.js.map