const switcherContainer: HTMLElement = document.getElementById('productType')!;
const switcherInputValue: HTMLSelectElement = (<HTMLSelectElement>document.getElementById('productType'))!;

const TypeContainer: {
    dvdType: HTMLElement,
    bookType: HTMLElement,
    furnitureType: HTMLElement
} = {
    dvdType: document.getElementById('switcher-input-container-type-dvd')!,
    bookType: document.getElementById('switcher-input-container-type-book')!,
    furnitureType: document.getElementById('switcher-input-container-type-furniture')!,
}

class Switcher
{
    private elements: HTMLElement[];

    public constructor(elements: HTMLElement[])
    {
        this.elements = elements;

        this.hideAllElements();
    }

    public hideAllElements(): void
    {
        for (let x = 0; x<this.elements.length; x++) {
            this.elements[x].style.display = "none";
        }
    }

    public showElement(element: HTMLElement): void
    {
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
})

// Trigger the change event to load the initial input field DVD
switcherContainer.dispatchEvent(new Event('change'));