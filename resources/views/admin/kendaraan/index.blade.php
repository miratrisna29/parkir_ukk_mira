@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3"><h3>Data Kendaraan</h3><a class="btn btn-primary" href="{{ route('admin.kendaraan.create') }}">Tambah Data</a></div>
<table class="table table-bordered table-striped"><thead><tr><th>Plat Nomor</th><th>Jenis</th><th>Warna</th><th>Pemilik</th><th>Aksi</th></tr></thead><tbody>@forelse($kendaraans as $k)<tr><td>{{ $k->plat_nomor ?? "-" }}</td><td>{{ $k->jenis_kendaraan ?? "-" }}</td><td>{{ $k->warna ?? "-" }}</td><td>{{ $k->pemilik ?? "-" }}</td><td><a class="btn btn-sm btn-warning" href="{{ route('admin.kendaraan.edit', $k) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('admin.kendaraan.destroy', $k) }}" onsubmit="return confirm('Hapus data ini?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form></td></tr>@empty<tr><td colspan="5" class="text-center">Belum ada data.</td></tr>@endforelse</tbody></table>{{ $kendaraans->links() }}
@endsection
