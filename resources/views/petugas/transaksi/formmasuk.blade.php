@extends('layouts.app')
@section('content')
<h3>Catat Kendaraan Masuk</h3>
@if($kendaraans->isEmpty() || $tarifs->isEmpty() || $areas->isEmpty())<div class="alert alert-warning">Pastikan data kendaraan, tarif, dan area parkir sudah tersedia serta area belum penuh.</div>@endif
<form method="POST" action="{{ route('petugas.transaksi.prosesMasuk') }}" class="card card-body" style="max-width:650px">
    @csrf
<div class="mb-3"><label class="form-label">Kendaraan</label><select name="id_kendaraan" class="form-select" required><option value="">Pilih kendaraan</option>@foreach($kendaraans as $k)<option value="{{ $k->id_kendaraan }}" @selected(old('id_kendaraan')==$k->id_kendaraan)>{{ $k->plat_nomor }} - {{ $k->jenis_kendaraan }} - {{ $k->pemilik }}</option>@endforeach</select></div>
<div class="mb-3"><label class="form-label">Tarif</label><select name="id_tarif" class="form-select" required><option value="">Pilih tarif</option>@foreach($tarifs as $t)<option value="{{ $t->id_tarif }}" @selected(old('id_tarif')==$t->id_tarif)>{{ ucfirst($t->jenis_kendaraan) }} - Rp{{ number_format($t->tarif_tetap,0,',','.') }}</option>@endforeach</select></div>
<div class="mb-3"><label class="form-label">Area Parkir</label><select name="id_area" class="form-select" required><option value="">Pilih area</option>@foreach($areas as $a)<option value="{{ $a->id_area }}" @selected(old('id_area')==$a->id_area)>{{ $a->nama_area }} ({{ $a->terisi }}/{{ $a->kapasitas }})</option>@endforeach</select></div>
<button class="btn btn-primary">Simpan Kendaraan Masuk</button></form>
@endsection
