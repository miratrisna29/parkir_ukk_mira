@extends('layouts.app')
@section('content')
<h3>Edit Kendaraan</h3>
 <form action="{{ route('admin.kendaraan.update',$kendaraan->id_kendaraan) }}"
          method="POST">
        @csrf
        @method('PUT')
<div class="mb-3"><label class="form-label">Plat Nomor</label><input type="text" name="plat_nomor" value="{{ old('plat_nomor', $kendaraan->plat_nomor ?? '') }}" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Jenis Kendaraan</label><select name="jenis_kendaraan" class="form-select" required><option value="">Pilih</option>
<option value="motor" @selected(old("jenis_kendaraan", $kendaraan->jenis_kendaraan ?? "") == "motor")>Motor</option>
<option value="mobil" @selected(old("jenis_kendaraan", $kendaraan->jenis_kendaraan ?? "") == "mobil")>Mobil</option>
</select></div>
<div class="mb-3"><label class="form-label">Warna</label><input type="text" name="warna" value="{{ old('warna', $kendaraan->warna ?? '') }}" class="form-control" ></div>
<div class="mb-3"><label class="form-label">Nama Pemilik</label><input type="text" name="pemilik" value="{{ old('pemilik', $kendaraan->pemilik ?? '') }}" class="form-control" required></div>
<button class="btn btn-primary">Simpan</button><a class="btn btn-secondary mt-2" href="{{ route('admin.kendaraan.index') }}">Kembali</a></form>
@endsection
