<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'CRUD Produk')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="/" class="navbar-brand">CRUD Produk</a>

            <ul class="navbar-nav flex-row ms-auto">
                <li class="nav-item me-3">
                    <a href="/" class="nav-link text-white">Home</a>
                </li>
                <li class="nav-item me-3">
                    <a href="/about" class="nav-link text-white">About</a>
                </li>
                <li class="nav-item me-3">
                    <a href="/contact" class="nav-link text-white">Contact</a>
                </li>
                <li class="nav-item me-3">
                    <a href="/products" class="nav-link text-white">Product</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>