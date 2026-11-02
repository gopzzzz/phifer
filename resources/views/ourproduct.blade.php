
@extends('layouts.mainlayout')

@section('content')

<style>
.page-container {
    background: #f5f7fb;
    min-height: 100vh;
    padding: 30px;
}

.page-header {
    margin-bottom: 25px;
}

.page-header h2 {
    font-size: 26px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 6px;
}

.page-header p {
    color: #64748b;
    font-size: 13px;
    margin-bottom: 0;
}

.table-container {
    background: #fff;
    border: 1px solid #e8edf4;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 3px 15px rgba(15,23,42,.035);
}

.table-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 18px;
    border-bottom: 1px solid #edf0f5;
}

.table-heading h5 {
    color: #1e293b;
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 5px;
}

.table-heading p {
    color: #94a3b8;
    font-size: 12px;
    margin-bottom: 0;
}

.product-count {
    background: #eef2ff;
    color: #4f46e5;
    padding: 8px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
}

.product-table {
    margin-bottom: 0;
    vertical-align: middle;
}

.product-table thead th {
    background: #f8fafc;
    color: #64748b;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    padding: 15px 13px;
    border-bottom: 1px solid #e8edf4;
    white-space: nowrap;
}

.product-table tbody td {
    padding: 17px 13px;
    color: #475569;
    font-size: 13px;
    border-bottom: 1px solid #f1f5f9;
}

.product-table tbody tr:hover {
    background: #fafbff;
}

.product-name {
    color: #1e293b;
    font-weight: 600;
    font-size: 14px;
}

.product-image {
    width: 75px;
    height: 65px;
    object-fit: cover;
    border-radius: 9px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    padding: 2px;
}

.no-image {
    width: 75px;
    height: 65px;
    border-radius: 9px;
    background: #f1f5f9;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #94a3b8;
    font-size: 11px;
}

.product-description {
    max-width: 300px;
    line-height: 1.6;
    color: #64748b;
}

.product-features {
    max-width: 280px;
    line-height: 1.7;
    color: #475569;
    white-space: pre-line;
}

.empty-message {
    text-align: center;
    padding: 60px 20px !important;
    color: #64748b !important;
}

.empty-message i {
    display: block;
    font-size: 40px;
    color: #cbd5e1;
    margin-bottom: 12px;
}

.table-footer {
    border-top: 1px solid #edf0f5;
    padding-top: 16px;
    margin-top: 5px;
    color: #94a3b8;
    font-size: 12px;
}

@media(max-width: 767px) {
    .page-container {
        padding: 15px;
    }

    .table-container {
        padding: 15px;
    }

    .product-table {
        min-width: 850px;
    }

    .page-header h2 {
        font-size: 22px;
    }
}
</style>

<div class="container-fluid page-container">

    <!-- Page Heading -->
    <div class="page-header">
        <h2>Our Products</h2>
        <p>Explore and manage your product information and details.</p>
    </div>

    <!-- Products Table -->
    <div class="table-container">

        <div class="table-heading">
            <div>
                <h5>Product List</h5>
                <p>All available products and their details.</p>
            </div>

            <span class="product-count">
                <i class="bi bi-box-seam me-1"></i>
                Total: {{ $products->count() }}
            </span>
        </div>

        <div class="table-responsive">

            <table class="table table-hover product-table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Features</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($products as $product)

                        <tr>
                            <!-- ID -->
                            <td>
                                {{ $product->id }}
                            </td>

                            <!-- Product Name -->
                            <td>
                                <span class="product-name">
                                    {{ $product->product_name }}
                                </span>
                            </td>

                            <!-- Product Image -->
                            <td>
                                @if (!empty($product->image))

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->product_name }}"
                                        class="product-image"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="no-image">
                                        No image
                                    </div>

                                @endif
                            </td>

                            <!-- Description -->
                            <td>
                                <div class="product-description">
                                    @if (!empty($product->description))
                                        {{ $product->description }}
                                    @else
                                        <span class="text-muted">
                                            No description available
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- Features -->
                            <td>
                                <div class="product-features">
                                    @if (!empty($product->features))
                                        {{ $product->features }}
                                    @else
                                        <span class="text-muted">
                                            No features available
                                        </span>
                                    @endif
                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="empty-message">
                                <i class="bi bi-box-seam"></i>
                                <h6 class="fw-bold text-secondary">
                                    No Products Found
                                </h6>
                                <p class="mb-0">
                                    There are currently no products available.
                                </p>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="table-footer">
            Showing {{ $products->count() }} product(s)
        </div>

    </div>

</div>

@endsection
