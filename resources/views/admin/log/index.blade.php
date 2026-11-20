@extends('layouts.app')
@section('content')
<h3>Log Aktivitas</h3><table class="table table-bordered"><thead><tr><th>Waktu</th><th>Nama User</th><th>Aktivitas</th></tr></thead><tbody>@forelse($logs as $log)<tr><td>{{ \Carbon\Carbon::parse($log->waktu_aktivitas)->format('d-m-Y H:i:s') }}</td><td>{{ $log->user->nama_lengkap ?? '-' }}</td><td>{{ $log->aktivitas }}</td></tr>@empty<tr><td colspan="3" class="text-center">Belum ada aktivitas.</td></tr>@endforelse</tbody></table>{{ $logs->links() }}
@endsection
