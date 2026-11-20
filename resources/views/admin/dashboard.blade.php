
@extends('layouts.app')

@section('content')

<h3>Dashboard Admin</h3>
<p>Selamat datang, {{ auth()->user()->nama_lengkap }}.</p>

<div class="row g-3">

    @foreach ([
        'Jumlah User' => $jumlahUser,
        'Jumlah Tarif' => $jumlahTarif,
        'Area Parkir' => $jumlahArea,
        'Data Kendaraan' => $jumlahKendaraan
    ] as $label => $angka)

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted">{{ $label }}</div>
                    <h3>{{ $angka }}</h3>
                </div>
            </div>
        </div>

    @endforeach

</div>

@endsection
