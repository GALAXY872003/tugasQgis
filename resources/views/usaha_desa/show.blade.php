@extends('layouts.app')

@section('content')
<!-- Tambahkan CSS Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

<div class="container">
    <div class="detail-header">
        <h1 class="page-title">Detail Usaha Desa</h1>
        <div class="action-buttons">
            <a href="{{ route('usaha_desa.edit', $usaha_desa->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>Edit
            </a>
            <a href="{{ route('usaha_desa.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>

    <div class="detail-container">
        <div class="row">
            <div class="col-md-6">
                <div class="info-card">
                    <h2 class="info-title">
                        <i class="fas fa-store me-2"></i>
                        Informasi Usaha
                    </h2>
                    <div class="info-body">
                        <div class="info-item">
                            <label>Nama Usaha</label>
                            <div class="value">{{ $usaha_desa->nama_usaha }}</div>
                        </div>
                        <div class="info-item">
                            <label>Jenis Usaha</label>
                            <div class="value">
                                <span class="business-type">{{ $usaha_desa->jenis_usaha }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <label>Deskripsi</label>
                            <div class="value description">
                                {{ $usaha_desa->deskripsi ?? 'Tidak ada deskripsi' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="info-card mt-4">
                    <h2 class="info-title">
                        <i class="fas fa-user me-2"></i>
                        Informasi Pemilik
                    </h2>
                    <div class="info-body">
                        <div class="info-item">
                            <label>Nama Pemilik</label>
                            <div class="value">{{ $usaha_desa->penduduk->nama_penduduk }}</div>
                        </div>
                        <div class="info-item">
                            <label>Alamat</label>
                            <div class="value">{{ $usaha_desa->penduduk->alamat }}</div>
                        </div>
                        <div class="info-item">
                            <label>RT/RW</label>
                            <div class="value">{{ $usaha_desa->penduduk->rt_rw }}</div>
                        </div>
                    </div>
                </div>

                <div class="info-card mt-4">
                    <h2 class="info-title">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        Lokasi Usaha
                    </h2>
                    <div class="info-body">
                        <div class="info-item">
                            <label>Koordinat</label>
                            <div class="value coordinates">{{ $usaha_desa->koordinat }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="map-card">
                    <h2 class="info-title">
                        <i class="fas fa-map me-2"></i>
                        Peta Lokasi
                    </h2>
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan JavaScript Leaflet -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    // Inisialisasi peta
    var coords = '{{ $usaha_desa->koordinat }}'.split(',');
    var lat = parseFloat(coords[0]);
    var lon = parseFloat(coords[1]);

    var map = L.map('map').setView([lat, lon], 15);

    // Tambahkan tile layer
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Tambahkan marker
    var marker = L.marker([lat, lon]).addTo(map);
    marker.bindPopup('<b>{{ $usaha_desa->nama_usaha }}</b><br>{{ $usaha_desa->jenis_usaha }}');

    // Tambahkan geocoder
    L.Control.geocoder({
        defaultMarkGeocode: false
    })
    .on('markgeocode', function(e) {
        var bbox = e.geocode.bbox;
        var poly = L.polygon([
            bbox.getSouthEast(),
            bbox.getNorthEast(),
            bbox.getNorthWest(),
            bbox.getSouthWest()
        ]).addTo(map);
        map.fitBounds(poly.getBounds());
    })
    .addTo(map);
</script>

<style>
.detail-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.action-buttons {
    display: flex;
    gap: 1rem;
}

.detail-container {
    background: white;
    border-radius: 10px;
    padding: 2rem;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.info-card, .map-card {
    background: #f8f9fa;
    border-radius: 8px;
    overflow: hidden;
    height: fit-content;
}

.info-title {
    background: #1a237e;
    color: white;
    padding: 1rem;
    font-size: 1.2rem;
    margin: 0;
}

.info-body {
    padding: 1.5rem;
}

.info-item {
    margin-bottom: 1.2rem;
}

.info-item:last-child {
    margin-bottom: 0;
}

.info-item label {
    display: block;
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 0.3rem;
}

.info-item .value {
    color: #2c3e50;
    font-size: 1.1rem;
    font-weight: 500;
}

.business-type {
    background: #e3f2fd;
    color: #1565c0;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

.description {
    font-weight: normal;
    font-size: 1rem;
    line-height: 1.5;
    color: #444;
}

.coordinates {
    font-family: monospace;
    background: #f5f5f5;
    padding: 0.5rem;
    border-radius: 4px;
    font-size: 1rem;
    color: #333;
}

/* Map Styles */
#map {
    height: 400px;
    width: 100%;
    border-radius: 0 0 8px 8px;
}

@media (max-width: 768px) {
    .detail-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }

    .action-buttons {
        width: 100%;
    }

    .action-buttons .btn {
        flex: 1;
    }

    .detail-container {
        padding: 1rem;
    }

    .info-card, .map-card {
        margin-bottom: 1rem;
    }

    .info-title {
        font-size: 1.1rem;
        padding: 0.8rem;
    }

    .info-body {
        padding: 1rem;
    }

    .info-item .value {
        font-size: 1rem;
    }

    #map {
        height: 300px;
    }
}
</style>
@endsection
