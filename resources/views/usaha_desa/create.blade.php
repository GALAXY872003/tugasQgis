@extends('layouts.app')

@section('content')
<!-- Tambahkan CSS Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

<div class="container">
    <h1 class="page-title">Tambah Usaha Desa</h1>

    <div class="form-container">
        <form action="{{ route('usaha_desa.store') }}" method="POST">
            @csrf
            
            @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="nama_usaha" class="form-label">Nama Usaha</label>
                        <input type="text" class="form-control @error('nama_usaha') is-invalid @enderror" 
                            id="nama_usaha" name="nama_usaha" value="{{ old('nama_usaha') }}" required>
                        @error('nama_usaha')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="jenis_usaha" class="form-label">Jenis Usaha</label>
                        <input type="text" class="form-control @error('jenis_usaha') is-invalid @enderror" 
                            id="jenis_usaha" name="jenis_usaha" value="{{ old('jenis_usaha') }}" required>
                        @error('jenis_usaha')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                            id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="penduduk_id" class="form-label">Pemilik Usaha</label>
                        <select class="form-select @error('penduduk_id') is-invalid @enderror" 
                            id="penduduk_id" name="penduduk_id" required>
                            <option value="">Pilih Pemilik Usaha</option>
                            @foreach($penduduk as $p)
                                <option value="{{ $p->id }}" {{ old('penduduk_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_penduduk }}
                                </option>
                            @endforeach
                        </select>
                        @error('penduduk_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Koordinat Lokasi</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('koordinat') is-invalid @enderror" 
                                id="koordinat" name="koordinat" value="{{ old('koordinat') }}" 
                                readonly required>
                            <button type="button" class="btn btn-primary" onclick="centerMapOnIndonesia()">
                                <i class="fas fa-crosshairs"></i> Reset Peta
                            </button>
                        </div>
                        <small class="text-muted">Klik pada peta untuk memilih lokasi</small>
                        @error('koordinat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="map-card">
                        <div id="map"></div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Simpan
                </button>
                <a href="{{ route('usaha_desa.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Tambahkan JavaScript Leaflet -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    // Koordinat default (Jepara)
    var defaultLat = -6.5825534;  // Latitude Jepara
    var defaultLng = 110.6681727; // Longitude Jepara
    var map, marker;

    // Inisialisasi peta
    function initMap() {
        map = L.map('map').setView([defaultLat, defaultLng], 12); // Zoom level 12 untuk area kabupaten

        // Tambahkan tile layer
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Tambahkan geocoder
        var geocoder = L.Control.geocoder({
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

        // Event ketika mengklik peta
        map.on('click', function(e) {
            // Hapus marker lama jika ada
            if (marker) {
                map.removeLayer(marker);
            }

            // Tambah marker baru
            marker = L.marker(e.latlng).addTo(map);
            
            // Update input koordinat
            document.getElementById('koordinat').value = e.latlng.lat + ',' + e.latlng.lng;
        });
    }

    // Reset peta ke posisi Jepara
    function centerMapOnIndonesia() {
        map.setView([defaultLat, defaultLng], 12);
        if (marker) {
            map.removeLayer(marker);
        }
        document.getElementById('koordinat').value = '';
    }

    // Inisialisasi peta saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });
</script>

<style>
.form-container {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.form-label {
    color: #1a237e;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.form-control, .form-select {
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    padding: 0.6rem 1rem;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #1a237e;
    box-shadow: 0 0 0 0.2rem rgba(26, 35, 126, 0.25);
}

.map-card {
    background: #f8f9fa;
    border-radius: 8px;
    overflow: hidden;
    height: 100%;
    min-height: 400px;
}

#map {
    height: 100%;
    min-height: 400px;
    width: 100%;
    border-radius: 8px;
}

.form-actions {
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 1px solid #e0e0e0;
    display: flex;
    gap: 1rem;
}

.alert-danger {
    background: #ffebee;
    border: none;
    border-left: 4px solid #c62828;
    color: #c62828;
    padding: 1rem 1.5rem;
    border-radius: 8px;
}

.alert-danger ul {
    list-style-type: none;
    padding-left: 0;
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .form-container {
        padding: 1rem;
    }

    .map-card {
        min-height: 300px;
        margin-top: 1rem;
    }

    #map {
        min-height: 300px;
    }

    .form-actions {
        flex-direction: column;
    }

    .form-actions .btn {
        width: 100%;
    }
}
</style>
@endsection
