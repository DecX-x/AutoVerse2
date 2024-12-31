<div class="modal-body">
    <!-- Basic Info -->
    <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" name="name" class="form-control" value="{{ isset($product) ? $product->name : old('name') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category" class="form-control" required>
            <option value="">Select Category</option>
            <option value="Cars" {{ (isset($product) && $product->category == 'Cars') ? 'selected' : '' }}>Cars</option>
            <option value="Parts" {{ (isset($product) && $product->category == 'Parts') ? 'selected' : '' }}>Parts</option>
            <option value="Accessories" {{ (isset($product) && $product->category == 'Accessories') ? 'selected' : '' }}>Accessories</option>
            <option value="Tools" {{ (isset($product) && $product->category == 'Tools') ? 'selected' : '' }}>Tools</option>
        </select>
    </div>

    <!-- Pricing -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Price (Rp)</label>
            <input type="number" name="price" step="0.01" class="form-control" value="{{ $product->price ?? old('price') }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Discount Price (Optional)</label>
            <input type="number" name="discount_price" step="0.01" class="form-control" value="{{ $product->discount_price ?? old('discount_price') }}">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" required>{{ $product->description ?? old('description') }}</textarea>
    </div>

    <!-- Badge -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Badge Text</label>
            <input type="text" name="badge" class="form-control" value="{{ $product->badge ?? old('badge') }}" placeholder="e.g., New, Sale, Hot">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Badge Color</label>
            <select name="badge_color" class="form-control">
                <option value="">Select Color</option>
                <option value="primary" {{ (isset($product) && $product->badge_color == 'primary') ? 'selected' : '' }}>Blue</option>
                <option value="success" {{ (isset($product) && $product->badge_color == 'success') ? 'selected' : '' }}>Green</option>
                <option value="danger" {{ (isset($product) && $product->badge_color == 'danger') ? 'selected' : '' }}>Red</option>
                <option value="warning" {{ (isset($product) && $product->badge_color == 'warning') ? 'selected' : '' }}>Yellow</option>
            </select>
        </div>
    </div>

    <!-- Shipping & Stock -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="form-check">
                <input type="checkbox" name="free_shipping" class="form-check-input" value="1" {{ isset($product) && $product->free_shipping ? 'checked' : '' }}>
                <label class="form-check-label">Free Shipping</label>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->stock ?? old('stock') }}" required>
        </div>
    </div>

    <!-- Image -->
    <div class="mb-4">
        <label class="form-label">Product Image</label>
        <input type="file" name="image" class="form-control" {{ isset($product) ? '' : 'required' }} accept="image/*">
        @if(isset($product) && $product->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $product->image) }}" class="rounded" width="100" alt="Current Image">
            </div>
        @endif
    </div>

    <!-- Features -->
    <div class="mb-4">
        <label class="form-label d-flex justify-content-between align-items-center">
            <span>Features</span>
            <button type="button" class="btn btn-sm btn-outline-primary add-feature">
                <i class="fas fa-plus"></i> Add Feature
            </button>
        </label>
        <div id="features-container">
            @if(isset($product) && $product->features)
                @foreach(is_array($product->features) ? $product->features : json_decode($product->features, true) as $feature)
                    <div class="input-group mb-2">
                        <input type="text" name="features[]" class="form-control" value="{{ $feature }}">
                        <button type="button" class="btn btn-outline-danger remove-field">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    
    <!-- Specifications -->
    <div class="mb-4">
        <label class="form-label d-flex justify-content-between align-items-center">
            <span>Specifications</span>
            <button type="button" class="btn btn-sm btn-outline-primary add-spec">
                <i class="fas fa-plus"></i> Add Specification
            </button>
        </label>
        <div id="specs-container">
            @if(isset($product) && $product->specifications)
                @foreach(is_array($product->specifications) ? $product->specifications : json_decode($product->specifications, true) as $key => $value)
                    <div class="input-group mb-2">
                        <input type="text" name="spec_keys[]" class="form-control" value="{{ $key }}" placeholder="Key">
                        <input type="text" name="spec_values[]" class="form-control" value="{{ $value }}" placeholder="Value">
                        <button type="button" class="btn btn-outline-danger remove-field">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update Product' : 'Add Product' }}</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add Feature
    document.querySelector('.add-feature').addEventListener('click', function() {
        const container = document.getElementById('features-container');
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" name="features[]" class="form-control" placeholder="Enter feature">
            <button type="button" class="btn btn-outline-danger remove-field">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
    });

    // Add Specification
    document.querySelector('.add-spec').addEventListener('click', function() {
        const container = document.getElementById('specs-container');
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" name="spec_keys[]" class="form-control" placeholder="Key">
            <input type="text" name="spec_values[]" class="form-control" placeholder="Value">
            <button type="button" class="btn btn-outline-danger remove-field">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
    });

    // Remove Field
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-field')) {
            e.target.closest('.input-group').remove();
        }
    });
});
</script>