<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Observatorio')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <style>
        body { overflow-x: hidden; }
        .sidebar {
            background-color: #0c6efd;
            min-height: 100vh;
        }
        .sidebar .nav-link { color: #fff; }
        .sidebar .nav-link:hover { color: #e2e6ea; }
    </style>
</head>
<body>
    <div class="d-flex">
        <nav class="sidebar flex-shrink-0 p-3">
            <a href="{{ url('/') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Observatorio</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page">
                        <i class="bi bi-house"></i> Inicio
                    </a>
                </li>
                <li>
                    <a href="{{ url('/usuarios') }}" class="nav-link">
                        <i class="bi bi-search"></i> Buscar
                    </a>
                </li>
                <li>
                    <a href="{{ url('/form/1/0/0') }}" class="nav-link">
                        <i class="bi bi-person-plus"></i> Gestionar nuevo usuario
                    </a>
                </li>
            </ul>
        </nav>
        <div class="container-fluid p-4">
            @yield('content')
        </div>
    </div>
    <!-- jQuery (necesario para DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
