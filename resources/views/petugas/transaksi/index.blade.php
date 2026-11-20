@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3"><h3>Kendaraan Sedang Parkir</h3><a href="{{ route('petugas.transaksi.formMasuk') }}" class="btn btn-primary">Catat Kendaraan Masuk</a></div>
<table class="table table-bordered table-striped"><thead><tr><th>Plat Nomor</th><th>Jenis</th><th>Area</th><th>Waktu Masuk</th><th>Tarif Keluar</th><th>Aksi</th></tr></thead><tbody>
@forelse($transaksiAktif as $t)<tr><td>{{ $t->kendaraan->plat_nomor }}</td><td>{{ ucfirst($t->kendaraan->jenis_kendaraan) }}</td><td>{{ $t->area->nama_area }}</td><td>{{ $t->waktu_masuk->format('d-m-Y H:i') }}</td><td>Rp{{ number_format($t->tarif->tarif_tetap,0,',','.') }}</td><td><a href="{{ route('petugas.transaksi.formKeluar',$t->id_parkir) }}" class="btn btn-sm btn-warning">Proses Keluar</a></td></tr>@empty<tr><td colspan="6" class="text-center">Tidak ada kendaraan yang sedang parkir.</td></tr>@endforelse
</tbody></table>
@endsection
