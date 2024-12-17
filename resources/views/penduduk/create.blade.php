<!-- resources/views/penduduk/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">Tambah Penduduk Baru</h1>

    <div class="form-container">
        <form action="{{ route('penduduk.store') }}" method="POST">
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
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="nama_penduduk" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama_penduduk') is-invalid @enderror" 
                            id="nama_penduduk" name="nama_penduduk" value="{{ old('nama_penduduk') }}" required>
                        @error('nama_penduduk')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                            id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="rt_rw" class="form-label">RT/RW</label>
                        <input type="text" class="form-control @error('rt_rw') is-invalid @enderror" 
                            id="rt_rw" name="rt_rw" value="{{ old('rt_rw') }}" 
                            placeholder="Contoh: 001/002" required>
                        @error('rt_rw')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="usia" class="form-label">Usia</label>
                        <input type="number" class="form-control @error('usia') is-invalid @enderror" 
                            id="usia" name="usia" value="{{ old('usia') }}" 
                            min="0" max="150" required>
                        @error('usia')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                            id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Simpan
                </button>
                <a href="{{ route('penduduk.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>

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

.form-actions {
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 1px solid #e0e0e0;
}

.form-actions .btn {
    padding: 0.6rem 1.5rem;
    font-weight: 500;
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
}

.invalid-feedback {
    color: #c62828;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

@media (max-width: 768px) {
    .form-container {
        padding: 1.5rem;
    }
    
    .form-actions .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>
@endsection
