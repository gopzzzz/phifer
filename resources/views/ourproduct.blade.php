
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
            padding: 30px;
        }

        .page-header {
            background: #fff;
            padding: 24px 28px;
            border: 1px solid #e6ebf2;
            border-radius: 12px;
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

        .table-container {
            background: #fff;
            border: 1px solid #e6ebf2;
            border-radius: 12px;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f1f4f9;
            color: #39465b;
            font-size: 13px;
            font-weight: 700;
            padding: 16px;
            white-space: nowrap;
            border-bottom: 1px solid #e2e8f0;
        }

        .table tbody td {
            padding: 16px;
            font-size: 14px;
            color: #4b5668;
            vertical-align: middle;
            border-color: #edf0f5;
        }

        .product-image {
            width: 85px;
            height: 70px;
            object-fit: contain;
            border: 1px solid #edf0f5;
            border-radius: 8px;
            padding: 4px;
            background: #fff;
        }

        .product-name {
            font-weight: 600;
            color: #263247;
        }

        .product-features {
            white-space: pre-line;
            min-width: 150px;
        }

        .empty-message {
            padding: 35px !important;
            text-align: center;
            color: #788397 !important;
        }

        @media (max-width: 768px) {
            .page-container {
                padding: 15px;
            }

            .page-header {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid page-container">

        <!-- Page Heading -->
        <div class="page-header">
            <h2>Our Products</h2>
            <p>View our products and their details.</p>
        </div>

        <!-- Products Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover align-middle">

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
                                <!-- ID Column -->
                                <td>{{ $product->id }}</td>

                                <!-- Product Name Column -->
                                <td>
                                    <span class="product-name">
                                        {{ $product->product_name }}
                                    </span>
                                </td>

                                <!-- Image Column -->
                                <td>
                                    @if (!empty($product->image))
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->product_name }}"
                                            class="product-image"
                                            loading="lazy"
                                        >
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>

                                <!-- Description Column -->
                                <td>
                                    @if (!empty($product->description))
                                        {{ $product->description }}
                                    @else
                                        <span class="text-muted">
                                            No description available
                                        </span>
                                    @endif
                                </td>

                                <!-- Features Column -->
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
                                    No products available.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</body>
</html>
