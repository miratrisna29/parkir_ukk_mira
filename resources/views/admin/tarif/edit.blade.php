@extends('layouts.app')
@section('content')
<h3>Edit Tarif</h3>
 <form action="{{ route('admin.tarif.update', $tarif->id_tarif) }}" method="POST">
            @csrf
            @method('PUT')

<div class="mb-3"><label class="form-label">Jenis Kendaraan</label><select name="jenis_kendaraan" class="form-select" required><option value="">Pilih</option>
<option value="motor" @selected(old("jenis_kendaraan", $tarif->jenis_kendaraan ?? "") == "motor")>Motor</option>
<option value="mobil" @selected(old("jenis_kendaraan", $tarif->jenis_kendaraan ?? "") == "mobil")>Mobil</option>
</select></div>
<div class="mb-3"><label class="form-label">Tarif Tetap (Rp)</label><input type="number" name="tarif_tetap" value="{{ old('tarif_tetap', $tarif->tarif_tetap ?? '') }}" class="form-control" required></div>
<button class="btn btn-primary">Simpan</button><a class="btn btn-secondary mt-2" href="{{ route('admin.tarif.index') }}">Kembali</a></form>
@endsection
