@extends('layouts.app')

@section('content')
    <style>
        /* Reset some default styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 20px;
        }

        /* Container styling */
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* Heading styling */
        h1 {
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: #007bff; /* Highlight border on focus */
            outline: none; /* Remove default outline */
        }

        button {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #007bff; /* Primary button color */
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease; /* Add transition for hover effect */
        }

        button:hover {
            background-color: #0056b3; /* Darker shade on hover */
            transform: translateY(-2px); /* Lift effect on hover */
        }
    </style>

    <div class="container">
        <h1>Edit Penduduk</h1>

        <form action="{{ route('penduduk.update', $penduduk->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nama_penduduk">Nama Penduduk:</label>
            <input type="text" name="nama_penduduk" value="{{ old('nama_penduduk', $penduduk->nama_penduduk) }}" required>

            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" value="{{ old('alamat', $penduduk->alamat) }}" required>

            <label for="rt_rw">RT/RW:</label>
            <input type="text" name="rt_rw" value="{{ old('rt_rw', $penduduk->rt_rw) }}" required>

            <label for="usia">Usia:</label>
            <input type="number" name="usia" value="{{ old('usia', $penduduk->usia) }}" required>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select name="jenis_kelamin" required>
                <option value="Laki-laki" {{ $penduduk->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $penduduk->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>

            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
@endsection
