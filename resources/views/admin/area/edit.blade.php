@extends('layouts.app')
@section('content')
<h3>Tambah Area Parkir</h3>
<form action="{{ route('admin.area.update', $area->id_area) }}"
          method="POST">
        @csrf
        @method('PUT')
<div class="mb-3"><label class="form-label">Nama Area</label><input type="text" name="nama_area" value="{{ old('nama_area', $area->nama_area ?? '') }}" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Kapasitas</label><input type="number" name="kapasitas" value="{{ old('kapasitas', $area->kapasitas ?? '') }}" class="form-control" required></div>
<button class="btn btn-light">Simpan</button><a class="btn btn-secondary mt-2" href="{{ route('admin.area.index') }}">Kembali</a></form>
@endsection
