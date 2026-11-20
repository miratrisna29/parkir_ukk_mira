@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3"><h3>Tarif Parkir</h3><a class="btn btn-primary" href="{{ route('admin.tarif.create') }}">Tambah Data</a></div>
<table class="table table-bordered table-striped"><thead><tr><th>Jenis Kendaraan</th><th>Tarif Tetap (Rp)</th><th>Aksi</th></tr></thead><tbody>@forelse($tarifs as $t)<tr><td>{{ $t->jenis_kendaraan ?? "-" }}</td><td>{{ $t->tarif_tetap ?? "-" }}</td><td><a class="btn btn-sm btn-warning" href="{{ route('admin.tarif.edit', $t) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('admin.tarif.destroy', $t) }}" onsubmit="return confirm('Hapus data ini?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form></td></tr>@empty<tr><td colspan="3" class="text-center">Belum ada data.</td></tr>@endforelse</tbody></table>{{ $tarifs->links() }}
@endsection
