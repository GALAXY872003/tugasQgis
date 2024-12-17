@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">Daftar Usaha Desa</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('usaha_desa.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Tambah Usaha Desa
        </a>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Usaha</th>
                    <th>Jenis Usaha</th>
                    <th>Deskripsi</th>
                    <th>Pemilik Usaha</th>
                    <th>Koordinat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usahaDesa as $usaha)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $usaha->nama_usaha }}</td>
                    <td>{{ $usaha->jenis_usaha }}</td>
                    <td>{{ $usaha->deskripsi ?? 'Tidak ada deskripsi' }}</td>
                    <td>{{ $usaha->penduduk->nama_penduduk }}</td>
                    <td>{{ $usaha->koordinat }}</td>
                    <td>
                        <a href="{{ route('usaha_desa.show', $usaha->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('usaha_desa.edit', $usaha->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('usaha_desa.destroy', $usaha->id) }}" method="POST" style="display:inline;">
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
@endsection
