@extends('layouts.app')
@section('content')
<h3>Dashboard Petugas</h3><p>Selamat datang, 
    {{ auth()->user()->nama_lengkap }}.</p>
<div class="card"><div class="card-body">
    <h5>Kendaraan Sedang Parkir</h5>
<h2>{{ $jumlahAktif }}</h2>
<a class="btn btn-primary" 
href="{{ route('petugas.transaksi.index') }}">Buka Transaksi</a> 
<a class="btn btn-outline-primary"
 href="{{ route('petugas.transaksi.formMasuk') }}"
 >Catat Kendaraan Masuk</a>
</div>
</div>
@endsection
