<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ProManager')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        /* Mengatur agar body menjadi kontainer flex untuk mendorong footer ke bawah */
        html, body {
            height: 100%;
        }
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fbff; 
            color: #334155; 
            display: flex;
            flex-direction: column;
        }
        .navbar { 
            background: #ffffff; 
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        main {
            flex: 1 0 auto; /* Memberikan ruang fleksibel agar footer terdorong ke bawah */
        }
        .footer {
            flex-shrink: 0;
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
        }
        .nav-link {
            font-weight: 500;
            color: #64748b !important;
        }
        .nav-link:hover, .nav-link.active {
            color: #4f46e5 !important;
        }
        .navbar-brand {
            font-weight: 700;
            color: #4f46e5 !important;
        }
    </style>
    @stack('styles')
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg py-3">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="/">
                    <i class="bi bi-box-seam-fill me-2 fs-4"></i>
                    ProManager
                </a>
                
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link px-3 {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 {{ Request::is('about') ? 'active' : '' }}" href="/about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 {{ Request::is('contact') ? 'active' : '' }}" href="/contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 {{ Request::is('products*') ? 'active fw-bold' : '' }}" href="/products">Product</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="footer py-4 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <span class="text-muted small">© {{ date('Y') }} <strong>ProManager</strong>. Latihan Laravel untuk Pemula.</span>
                </div>
                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item me-3">
                            <a href="#" class="text-muted small text-decoration-none"><i class="bi bi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item me-3">
                            <a href="#" class="text-muted small text-decoration-none"><i class="bi bi-instagram"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-muted small text-decoration-none"><i class="bi bi-github"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>