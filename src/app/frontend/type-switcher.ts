const switcherContainer: HTMLElement = document.getElementById('productType')!;
const switcherInputValue: HTMLSelectElement = (<HTMLSelectElement>document.getElementById('productType'))!;

const TypeContainers: {
    dvdType: HTMLElement,
    bookType: HTMLElement,
    furnitureType: HTMLElement
} = {
    dvdType: document.getElementById('switcher-input-container-type-dvd')!,
    bookType: document.getElementById('switcher-input-container-type-book')!,
    furnitureType: document.getElementById('switcher-input-container-type-furniture')!,
}

TypeContainers.dvdType.style.display = "none"
TypeContainers.bookType.style.display = "none"
TypeContainers.furnitureType.style.display = "none"

switcherContainer.addEventListener("change", function () {
    if (switcherInputValue.value === "dvd") {
        TypeContainers.dvdType.style.display = ""
        TypeContainers.bookType.style.display = "none"
        TypeContainers.furnitureType.style.display = "none"
    }

    if (switcherInputValue.value === "book") {
        TypeContainers.dvdType.style.display = "none"
        TypeContainers.bookType.style.display = ""
        TypeContainers.furnitureType.style.display = "none"
    }

    if (switcherInputValue.value === "furniture") {
        TypeContainers.dvdType.style.display = "none"
        TypeContainers.bookType.style.display = "none"
        TypeContainers.furnitureType.style.display = ""
    }
})

// Trigger the change event to load the initial input field DVD
switcherContainer.dispatchEvent(new Event('change'));