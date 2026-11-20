@extends('layouts.app')
@section('content')
<h3>Tambah User</h3>
<form method="POST" action="{{ route('admin.user.store') }}" class="card card-body" style="max-width:600px">
@csrf
<div class="mb-3"><label class="form-label">Nama Lengkap</label><input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap ?? '') }}" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Username</label><input type="text" name="username" value="{{ old('username', $user->username ?? '') }}" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Password </label><input type="password" name="password" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Role</label><select name="role" class="form-select" required><option value="">Pilih</option>
<option value="admin" @selected(old("role", $user->role ?? "") == "admin")>Admin</option>
<option value="petugas" @selected(old("role", $user->role ?? "") == "petugas")>Petugas</option>
<option value="owner" @selected(old("role", $user->role ?? "") == "owner")>Owner</option>
</select></div>
<div class="mb-3"><label>Status</label><select name="status_aktif" class="form-select"><option value="1" @selected(old("status_aktif", $user->status_aktif ?? 1) == 1)>Aktif</option><option value="0" @selected(old("status_aktif", $user->status_aktif ?? 1) == 0)>Nonaktif</option></select></div>
<button class="btn btn-primary">Simpan</button><a class="btn btn-secondary mt-2" href="{{ route('admin.user.index') }}">Kembali</a></form>
@endsection
