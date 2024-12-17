@extends('layouts.app')

@section('content')
    <h1>Detail Penduduk</h1>
    <p><strong>Nama:</strong> {{ $penduduk->nama_penduduk }}</p>
    <p><strong>Alamat:</strong> {{ $penduduk->alamat }}</p>
    <p><strong>RT/RW:</strong> {{ $penduduk->rt_rw }}</p>
    <p><strong>Usia:</strong> {{ $penduduk->usia }}</p>
    <p><strong>Jenis Kelamin:</strong> {{ $penduduk->jenis_kelamin }}</p>

    <h2>Usaha Desa Terkait</h2>
    @if ($usahaDesa->isEmpty())
        <p>Tidak ada usaha desa terkait.</p>
    @else
        <ul>
            @foreach ($usahaDesa as $usaha)
                <li>{{ $usaha->nama_usaha }} - {{ $usaha->deskripsi }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('penduduk.index') }}">Kembali ke Daftar Penduduk</a>
@endsection
