@extends('layouts.app')
@section('content')
<h3>Konfirmasi Kendaraan Keluar</h3><div class="card card-body" style="max-width:550px">
<p><strong>Plat Nomor:</strong> {{ $transaksi->kendaraan->plat_nomor }}</p><p><strong>Jenis:</strong> {{ ucfirst($transaksi->kendaraan->jenis_kendaraan) }}</p><p><strong>Waktu Masuk:</strong> {{ $transaksi->waktu_masuk->format('d-m-Y H:i') }}</p><p><strong>Tarif Tetap:</strong> Rp{{ number_format($biaya,0,',','.') }}</p>
<form method="POST" action="{{ route('petugas.transaksi.prosesKeluar',$transaksi->id_parkir) }}">
    @csrf
    <button class="btn btn-success">Konfirmasi Keluar & Cetak Struk</button></form></div>
@endsection
