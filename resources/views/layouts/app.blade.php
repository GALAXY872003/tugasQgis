<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Geografis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #ffffff;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Navbar Styles */
    .navbar {
        background: #1a237e;
        padding: 0;
        height: 70px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .navbar-brand-text {
        color: #ffffff !important;
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin: 0;
        padding: 0 1.5rem;
        display: flex;
        align-items: center;
        height: 100%;
        text-decoration: none;
        border-right: 1px solid rgba(255, 255, 255, 0.1);
    }

    .navbar-brand-text span {
        color: #64b5f6;
        margin-right: 5px;
    }

    .navbar-brand {
        color: #ffffff !important;
        font-size: 1.2rem;
        font-weight: 500;
        padding: 0 1rem;
    }

    .navbar .nav-link {
        color: #ffffff !important;
        padding: 0 1.5rem !important;
        font-weight: 500;
        font-size: 1rem;
        height: 70px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .navbar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Container Styles */
    .container.mt-4 {
        flex: 1;
        padding: 2rem 1rem;
        background-color: #ffffff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        margin-top: 2rem !important;
    }

    /* Table Styles */
    .table-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .table thead th {
        background: #1a237e;
        color: white;
        font-weight: 600;
        padding: 1rem;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #e0e0e0;
    }

    /* Button Styles */
    .btn {
        padding: 0.5rem 1rem;
        border-radius: 5px;
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: #1a237e;
        border-color: #1a237e;
    }

    .btn-warning {
        background: #ff9800;
        border-color: #ff9800;
        color: white;
    }

    .btn-danger {
        background: #f44336;
        border-color: #f44336;
    }

    /* Page Title */
    .page-title {
        color: #1a237e;
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    /* Alert Styles */
    .alert-success {
        background: #e8f5e9;
        color: #2e7d32;
        border-left: 4px solid #2e7d32;
        border-radius: 8px;
        padding: 1rem 1.5rem;
    }

    /* Stats Card */
    .stats-card {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .stats-card-header {
        color: #1a237e;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        text-transform: uppercase;
    }

    .stats-card-value {
        font-size: 2rem;
        font-weight: 700;
        color: #0d47a1;
    }

    /* Footer */
    footer {
        background: #1a237e;
        color: #ffffff;
        padding: 1.5rem 0;
        margin-top: 2rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .navbar {
            padding: 0.5rem 0;
            height: auto;
        }

        .navbar-brand, .navbar-brand-text {
            font-size: 1.2rem;
        }

        .table-container {
            padding: 1rem;
            overflow-x: auto;
        }

        .table thead th {
            padding: 0.75rem;
            font-size: 0.8rem;
        }

        .table td {
            padding: 0.75rem;
            font-size: 0.9rem;
        }

        .btn {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }

        .page-title {
            font-size: 1.5rem;
        }
    }
</style>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand-text">
                <span>Usaha</span>Suwawal
            </a>
            <a class="navbar-brand" href="{{ url('/dashboard') }}">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('penduduk.index') }}">Daftar Penduduk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('usaha_desa.index') }}">Daftar Usaha Desa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="text-center">
        <p>&copy; 2024 Desa Suwawal Timur. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
