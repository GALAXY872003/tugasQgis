@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">Daftar Penduduk</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('penduduk.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Tambah Penduduk
        </a>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Penduduk</th>
                    <th>Detail Lokasi</th>
                    <th>Usia</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penduduk as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nama_penduduk }}</td>
                    <td>
                        <div class="location-details">
                            <span class="address">{{ $p->alamat }}</span>
                            <span class="rt-rw">RT/RW: {{ $p->rt_rw }}</span>
                        </div>
                    </td>
                    <td>{{ $p->usia }} Tahun</td>
                    <td>
                        <span class="gender-badge {{ $p->jenis_kelamin == 'Laki-laki' ? 'male' : 'female' }}">
                            {{ $p->jenis_kelamin }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('penduduk.edit', $p->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('penduduk.destroy', $p->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
.location-details {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.location-details .address {
    font-weight: 500;
}

.location-details .rt-rw {
    font-size: 0.9rem;
    color: #666;
}

.gender-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

.gender-badge.male {
    background-color: #e3f2fd;
    color: #1565c0;
}

.gender-badge.female {
    background-color: #fce4ec;
    color: #c2185b;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .location-details {
        gap: 2px;
    }
    
    .location-details .address {
        font-size: 0.9rem;
    }
    
    .location-details .rt-rw {
        font-size: 0.8rem;
    }
    
    .gender-badge {
        padding: 3px 8px;
        font-size: 0.8rem;
    }
}
</style>
@endsection
