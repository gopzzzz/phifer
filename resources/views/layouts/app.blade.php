
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f4f7fb;
            color: #253047;
            margin: 0;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .edit-page {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 20px;
        }

        .page-header h2 {
            font-size: 27px;
            font-weight: 700;
        }

        .page-header p {
            color: #778197;
        }

        .settings-card {
            background: white;
            border: 1px solid #e4e9f1;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 22px;
            box-shadow: 0 4px 15px rgba(25, 40, 70, .04);
        }

        .settings-card h5 {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 22px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .edit-page .form-control {
            padding: 11px 12px;
            border: 1px solid #dce2eb;
            border-radius: 7px;
        }

        .edit-page .form-control:focus {
            border-color: #5378d7;
            box-shadow: 0 0 0 3px rgba(83, 120, 215, .12);
        }

        .banner-preview {
            width: 100%;
            max-height: 230px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .save-area {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 30px;
        }

        .save-area .btn {
            padding: 11px 25px;
            border-radius: 7px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
