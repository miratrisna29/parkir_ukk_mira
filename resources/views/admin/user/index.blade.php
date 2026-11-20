@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3"><h3>Data User</h3><a class="btn btn-primary" href="{{ route('admin.user.create') }}">Tambah Data</a></div>
<table class="table table-bordered table-striped"><thead><tr><th>Nama</th><th>Username</th><th>Role</th><th>Status</th><th>Aksi</th></tr></thead><tbody>@forelse($users as $u)<tr><td>{{ $u->nama_lengkap ?? "-" }}</td><td>{{ $u->username ?? "-" }}</td><td>{{ $u->role ?? "-" }}</td><td>{{ $u->status_aktif ?? "-" }}</td><td><a class="btn btn-sm btn-warning" href="{{ route('admin.user.edit', $u) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('admin.user.destroy', $u) }}" onsubmit="return confirm('Hapus data ini?')">
    @csrf 
    @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form></td></tr>@empty<tr><td colspan="5" class="text-center">Belum ada data.</td></tr>@endforelse</tbody></table>{{ $users->links() }}
@endsection
