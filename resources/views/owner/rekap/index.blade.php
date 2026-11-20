@extends('layouts.app')
@section('content')
<h3>Laporan Transaksi</h3>
<form method="GET" class="row g-2 mb-3"><div class="col-auto"><label class="form-label">Dari</label><input type="date" name="dari" value="{{ request('dari') }}" class="form-control"></div><div class="col-auto"><label class="form-label">Sampai</label><input type="date" name="sampai" value="{{ request('sampai') }}" class="form-control"></div><div class="col-auto align-self-end"><button class="btn btn-primary">Filter</button> <a href="{{ route('owner.rekap.index') }}" class="btn btn-secondary">Reset</a></div></form>
<div class="alert alert-info">Total Pendapatan: <strong>Rp{{ number_format($totalPendapatan,0,',','.') }}</strong></div>
<table class="table table-bordered table-striped"><thead><tr><th>Plat Nomor</th><th>Area</th><th>Masuk</th><th>Keluar</th><th>Biaya</th></tr></thead><tbody>@forelse($transaksis as $t)<tr><td>{{ $t->kendaraan->plat_nomor }}</td><td>{{ $t->area->nama_area }}</td><td>{{ $t->waktu_masuk->format('d-m-Y H:i') }}</td><td>{{ optional($t->waktu_keluar)->format('d-m-Y H:i') }}</td><td>Rp{{ number_format($t->biaya_total ?? 0,0,',','.') }}</td></tr>@empty<tr><td colspan="5" class="text-center">Belum ada transaksi selesai.</td></tr>@endforelse</tbody></table>{{ $transaksis->links() }}
@endsection
