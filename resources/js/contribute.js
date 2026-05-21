const IMAGES_INPUT = document.getElementById("images");
const CLEAR_SELECTED_IMAGES_BTN = document.getElementById('clearSelectedImages');

function updateSelectedImagePreview() {
    document.getElementById('selectedImages').innerHTML = "";
    document.getElementById('ignoredImages').innerHTML = "";

    const files = [...IMAGES_INPUT.files];
    files.splice(10);

    let index = 0;
    for (const img of files) {
        const imagePreview = document.createElement("img");
        imagePreview.src = URL.createObjectURL(img);
        imagePreview.className = "selectedImagePreview";
        imagePreview.style = `--index: ${index};--y-offset: ${Math.floor(Math.random() * 10)}px;`;
        document.getElementById('selectedImages').appendChild(imagePreview);

        index++;
    }

    document.getElementById('selectedImages').style = `--total-image-nb: ${index};`;

    if (IMAGES_INPUT.files.length > 10) {
        document.getElementById('ignoredImages').innerHTML = `<i class='iiicon' data-name='warning'></i> <span>${IMAGES_INPUT.files.length - 10} image${IMAGES_INPUT.files.length - 10 > 1 ? "s":""} ignored (Max 10 files)</span>`;
    }

}

IMAGES_INPUT.addEventListener("change", updateSelectedImagePreview);

CLEAR_SELECTED_IMAGES_BTN.addEventListener('click', () => {
    IMAGES_INPUT.value = "";
    updateSelectedImagePreview();
    IMAGES_INPUT.focus();
});

IMAGES_INPUT.value = "";
