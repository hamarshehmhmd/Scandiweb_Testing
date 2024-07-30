document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('productType')?.addEventListener('change', handleProductTypeChange);
});

function handleProductTypeChange() {
    const type = document.getElementById('productType').value;
    const typeAttributes = document.getElementById('typeAttributes');
    
    typeAttributes.innerHTML = ''; // Clear previous attributes
    
    switch (type) {
        case 'DVD':
            typeAttributes.innerHTML = `
                <div class="form-group">
                    <label for="size">Size (MB):</label>
                    <input type="text" class="form-control" id="size" name="size" placeholder="e.g. 500 MB" required>
                </div>
            `;
            break;
        case 'Book':
            typeAttributes.innerHTML = `
                <div class="form-group">
                    <label for="weight">Weight (Kg):</label>
                    <input type="text" class="form-control" id="weight" name="weight" placeholder="e.g. 1 KG" required>
                </div>
            `;
            break;
        case 'Furniture':
            typeAttributes.innerHTML = `
                <div class="form-group">
                    <label for="height">Height (cm):</label>
                    <input type="text" class="form-control" id="height" name="height" placeholder="e.g. 100 CM" required>
                </div>
                <div class="form-group">
                    <label for="width">Width (cm):</label>
                    <input type="text" class="form-control" id="width" name="width" placeholder="e.g. 50 CM" required>
                </div>
                <div class="form-group">
                    <label for="length">Length (cm):</label>
                    <input type="text" class="form-control" id="length" name="length" placeholder="e.g. 200 CM" required>
                </div>
            `;
            break;
    }
}


/**
 * Handles the mass delete button click.
 * Submits the form to delete selected products.
 */
function handleMassDelete() {
    const form = document.getElementById('productForm');
    if (form) {
        form.submit();
    }
}
