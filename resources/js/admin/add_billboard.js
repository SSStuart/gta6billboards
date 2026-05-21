
function updatePreview() {
    const width = document.getElementById('width').value;
    const height = document.getElementById('height').value;
    document.getElementById('sizePreview').style = `--width: ${width}; --height: ${height}`;
}

document.getElementById('width').addEventListener('input', () => {
    updatePreview();
});
document.getElementById('height').addEventListener('input', () => {
    updatePreview();
});

document.getElementById('image').addEventListener('input', function () {
    var file = this.files[0];
    let url = window.URL.createObjectURL(file);
    document.getElementById('imagePreview').src = url;
});

document.getElementById('addContributorBtn').addEventListener('click', () => {
    document.getElementById('newContribCont').classList.remove('hidden');
    document.getElementById('newContributorUsername').setAttribute('required', true);
    document.getElementById('existingContribCont').classList.add('hidden');
    document.getElementById('contributorId').removeAttribute('required');
});

document.getElementById('addZoneBtn').addEventListener('click', () => {
    document.getElementById('newZoneCont').classList.remove('hidden');
    document.getElementById('newZoneName').setAttribute('required', true);
    document.getElementById('existingZoneCont').classList.add('hidden');
    document.getElementById('zoneId').removeAttribute('required');
});