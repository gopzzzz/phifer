
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Our Products</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            font-family: Arial, sans-serif;
            color: #263247;
        }

        .page-container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 25px;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-header h2 {
            font-size: 25px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #788397;
            font-size: 14px;
            margin-bottom: 0;
        }

        .form-container,
        .table-container {
            background: #fff;
            border: 1px solid #e6ebf2;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .04);
        }

        .form-container {
            padding: 24px;
            margin-bottom: 25px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
        }

        .form-control {
            border-color: #dbe2ea;
            border-radius: 7px;
            padding: 10px 12px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #64748b;
            box-shadow: 0 0 0 3px rgba(100, 116, 139, .12);
        }

        .btn {
            border-radius: 7px;
            padding: 9px 15px;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-main {
            background: #1e293b;
            border: 1px solid #1e293b;
            color: #fff;
        }

        .btn-main:hover {
            background: #334155;
            color: #fff;
        }

        .btn-edit {
            background: #fff;
            border: 1px solid #cbd5e1;
            color: #334155;
        }

        .btn-edit:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        .btn-delete {
            background: #fff;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #fef2f2;
            color: #b91c1c;
        }

        .table-heading {
            padding: 20px 24px;
            border-bottom: 1px solid #edf0f5;
        }

        .table-heading h5 {
            font-weight: 700;
            margin-bottom: 5px;
        }

        .table-heading p {
            font-size: 13px;
            color: #788397;
            margin: 0;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f1f4f9;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            padding: 16px;
            white-space: nowrap;
            border-bottom: 1px solid #e2e8f0;
        }

        .table tbody td {
            padding: 16px;
            font-size: 13px;
            color: #4b5668;
            vertical-align: middle;
            border-bottom: 1px solid #edf0f5;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background: #fafbfe;
        }

        .product-name {
            font-weight: 600;
            color: #263247;
            min-width: 130px;
        }

        .product-image {
            width: 78px;
            height: 58px;
            object-fit: contain;
            border: 1px solid #edf0f5;
            border-radius: 7px;
            padding: 4px;
            background: #fff;
        }

        .no-image {
            width: 78px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 11px;
        }

        .product-description {
            max-width: 250px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .product-features {
            max-width: 250px;
            white-space: pre-line;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .action-buttons form {
            margin: 0;
        }

        .table-footer {
            padding: 15px 20px;
            color: #64748b;
            font-size: 12px;
            border-top: 1px solid #edf0f5;
        }

        .empty-message {
            padding: 40px !important;
            text-align: center;
            color: #788397 !important;
        }

        @media (max-width: 768px) {
            .page-container {
                margin: 22px auto;
                padding: 0 12px;
            }

            .page-header h2 {
                font-size: 23px;
            }

            .form-container {
                padding: 17px;
            }

            .table-heading {
                padding: 17px;
            }

            .table thead th,
            .table tbody td {
                padding: 13px;
            }
        }
    </style>
</head>

<body>

<div class="container-fluid page-container">

    {{-- Page Header --}}
    <div class="page-header d-flex justify-content-between align-items-center">

        <div>
            <h2>Our Products</h2>
            <p>View and manage your product details.</p>
        </div>

        <button type="button"
                class="btn btn-main"
                onclick="showAddForm()">
            + Add Product
        </button>

    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following errors:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Add / Edit Product Form --}}
    <div class="form-container"
         id="productFormCard"
         style="{{ $errors->any() || isset($editProduct) ? '' : 'display:none;' }}">

        <div class="mb-4">
            <h5 class="fw-bold mb-1" id="formTitle">
                {{ isset($editProduct) ? 'Edit Product' : 'Add Product' }}
            </h5>

            <p class="text-muted small mb-0">
                Enter the product information below.
            </p>
        </div>

        <form id="productForm"
              action="{{ isset($editProduct) ? route('our-products.update', $editProduct->id) : route('our-products.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <input type="hidden"
                   name="_method"
                   id="formMethod"
                   value="{{ isset($editProduct) ? 'PUT' : 'POST' }}">

            <div class="row">

                {{-- Product Name --}}
                <div class="col-md-6 mb-3">

                    <label for="product_name" class="form-label">
                        Product Name <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="product_name"
                           id="product_name"
                           class="form-control @error('product_name') is-invalid @enderror"
                           value="{{ old('product_name', isset($editProduct) ? $editProduct->product_name : '') }}"
                           maxlength="255"
                           required>

                    @error('product_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Product Image --}}
                <div class="col-md-6 mb-3">

                    <label for="product_image" class="form-label">
                        Product Image
                    </label>

                    <input type="file"
                           name="image"
                           id="product_image"
                           class="form-control @error('image') is-invalid @enderror"
                           accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

                    <small class="text-muted">
                        JPG, PNG or WEBP. Maximum 2 MB.
                    </small>

                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div id="imagePreview" class="mt-2">

                        @if(isset($editProduct) && $editProduct->image)
                            <img src="{{ asset('storage/' . $editProduct->image) }}"
                                 class="product-image"
                                 alt="Current product image">
                        @endif

                    </div>

                </div>

                {{-- Description --}}
                <div class="col-12 mb-3">

                    <label for="description" class="form-label">
                        Description
                    </label>

                    <textarea name="description"
                              id="description"
                              rows="4"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', isset($editProduct) ? $editProduct->description : '') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Features --}}
                <div class="col-12 mb-4">

                    <label for="features" class="form-label">
                        Features
                    </label>

                    <textarea name="features"
                              id="features"
                              rows="4"
                              class="form-control @error('features') is-invalid @enderror"
                              placeholder="Enter product features">{{ old('features', isset($editProduct) ? $editProduct->features : '') }}</textarea>

                    @error('features')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            {{-- Form Buttons --}}
            <button type="submit"
                    class="btn btn-main"
                    id="submitButton">
                {{ isset($editProduct) ? 'Update Product' : 'Save Product' }}
            </button>

            <button type="button"
                    class="btn btn-edit ms-2"
                    onclick="hideForm()">
                Cancel
            </button>

        </form>

    </div>

    {{-- Product List --}}
    <div class="table-container">

        <div class="table-heading d-flex justify-content-between align-items-center">

            <div>
                <h5>Product List</h5>
                <p>All registered products</p>
            </div>

            <span class="badge bg-light text-dark border">
                Total: {{ $products->count() }}
            </span>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Features</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($products as $product)

                        <tr>

                            {{-- ID --}}
                            <td>
                                {{ $product->id }}
                            </td>

                            {{-- Product Name --}}
                            <td>
                                <span class="product-name">
                                    {{ $product->product_name }}
                                </span>
                            </td>

                            {{-- Image --}}
                            <td>
                                @if (!empty($product->image))

                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->product_name }}"
                                         class="product-image"
                                         loading="lazy">

                                @else

                                    <div class="no-image">
                                        No image
                                    </div>

                                @endif
                            </td>

                            {{-- Description --}}
                            <td>
                                <div class="product-description">
                                    {{ $product->description ?: 'No description available' }}
                                </div>
                            </td>

                            {{-- Features --}}
                            <td>
                                <div class="product-features">
                                    {{ $product->features ?: 'No features available' }}
                                </div>
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div class="action-buttons">

                                    {{-- Edit --}}
                                    <a href="{{ route('our-products.edit', $product->id) }}"
                                       class="btn btn-edit">
                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('our-products.destroy', $product->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this product?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-delete">
                                            Delete
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="empty-message">

                                <h6 class="fw-bold text-secondary">
                                    No products found
                                </h6>

                                <p class="mb-0">
                                    There are currently no product records to display.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Table Footer --}}
        <div class="table-footer">
            Showing {{ $products->count() }} product(s)
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

    const formCard = document.getElementById('productFormCard');
    const productForm = document.getElementById('productForm');

    // Open Add Product Form
    function showAddForm() {

        productForm.reset();

        // Set Add route
        productForm.action = "{{ route('our-products.store') }}";

        // Set POST method
        document.getElementById('formMethod').value = 'POST';

        // Update heading
        document.getElementById('formTitle').textContent = 'Add Product';

        // Update button
        document.getElementById('submitButton').textContent = 'Save Product';

        // Clear image preview
        document.getElementById('imagePreview').innerHTML = '';

        // Show form
        formCard.style.display = 'block';

        // Scroll to form
        formCard.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

    // Hide Form
    function hideForm() {
        formCard.style.display = 'none';
    }

    // Product Image Preview
    document.getElementById('product_image').addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {
            return;
        }

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {
            alert('Please select a JPG, PNG or WEBP image.');

            this.value = '';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Image size must not exceed 2 MB.');

            this.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {

            const preview = document.getElementById('imagePreview');

            const img = document.createElement('img');

            img.src = event.target.result;
            img.alt = 'Selected product image preview';
            img.className = 'product-image';

            preview.replaceChildren(img);
        };

        reader.readAsDataURL(file);

    });

</script>

</body>
</html>
