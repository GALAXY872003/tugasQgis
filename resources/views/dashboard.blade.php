@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">Dashboard</h1>

    <div class="table-container mb-4">
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="stats-card">
                    <div class="stats-card-header">
                        <i class="fas fa-store me-2"></i>
                        Jumlah Usaha Desa
                    </div>
                    <div class="stats-card-value">{{ $usaha_desa }}</div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="stats-card">
                    <div class="stats-card-header">
                        <i class="fas fa-users me-2"></i>
                        Total Penduduk
                    </div>
                    <div class="stats-card-value">{{ $totalPenduduk }}</div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="stats-card">
                    <div class="stats-card-header">
                        <i class="fas fa-male me-2"></i>
                        Laki-laki
                    </div>
                    <div class="stats-card-value">{{ $jumlahLakiLaki }}</div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="stats-card">
                    <div class="stats-card-header">
                        <i class="fas fa-female me-2"></i>
                        Perempuan
                    </div>
                    <div class="stats-card-value">{{ $jumlahPerempuan }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="table-container">
                <h2 class="stats-card-header mb-3">
                    <i class="fas fa-users me-2"></i>
                    Statistik Penduduk
                </h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Laki-laki</td>
                            <td>{{ $jumlahLakiLaki }}</td>
                            <td>{{ number_format(($jumlahLakiLaki / $totalPenduduk) * 100, 1) }}%</td>
                        </tr>
                        <tr>
                            <td>Perempuan</td>
                            <td>{{ $jumlahPerempuan }}</td>
                            <td>{{ number_format(($jumlahPerempuan / $totalPenduduk) * 100, 1) }}%</td>
                        </tr>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>{{ $totalPenduduk }}</strong></td>
                            <td><strong>100%</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="table-container">
                <h2 class="stats-card-header mb-3">
                    <i class="fas fa-store me-2"></i>
                    Statistik Usaha Desa
                </h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total Usaha Desa</td>
                            <td>{{ $usaha_desa }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="btn-group">
            <a href="{{ route('penduduk.index') }}" class="btn btn-primary">
                <i class="fas fa-users me-2"></i>Lihat Daftar Penduduk
            </a>
            <a href="{{ route('usaha_desa.index') }}" class="btn btn-primary ms-2">
                <i class="fas fa-store me-2"></i>Lihat Daftar Usaha
            </a>
        </div>
    </div>
</div>

<style>
.stats-card {
    background: white;
    border-radius: 10px;
    padding: 1.5rem;
    height: 100%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
}

.stats-card-header {
    color: #1a237e;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-transform: uppercase;
}

.stats-card-value {
    font-size: 2.5rem;
    font-weight: 700;
    color: #0d47a1;
}

.table-container {
    background: white;
    border-radius: 10px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

@media (max-width: 768px) {
    .stats-card {
        margin-bottom: 1rem;
    }

    .stats-card-header {
        font-size: 1rem;
    }

    .stats-card-value {
        font-size: 2rem;
    }

    .btn-group {
        flex-direction: column;
        width: 100%;
    }

    .btn-group .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .btn-group .ms-2 {
        margin-left: 0 !important;
    }
}
</style>
@endsection
