@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3"><h3>Area Parkir</h3><a class="btn btn-primary" href="{{ route('admin.area.create') }}">Tambah Data</a></div>
<table class="table table-bordered table-striped"><thead><tr><th>Nama Area</th><th>Kapasitas</th><th>Terisi</th><th>Aksi</th></tr></thead><tbody>@forelse($areas as $a)<tr><td>{{ $a->nama_area ?? "-" }}</td><td>{{ $a->kapasitas ?? "-" }}</td><td>{{ $a->terisi ?? "-" }}</td><td><a class="btn btn-sm btn-warning" href="{{ route('admin.area.edit', $a) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('admin.area.destroy', $a) }}" onsubmit="return confirm('Hapus data ini?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form></td></tr>@empty<tr><td colspan="4" class="text-center">Belum ada data.</td></tr>@endforelse</tbody></table>{{ $areas->links() }}
@endsection
