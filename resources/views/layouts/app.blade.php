
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Aplikasi Parkir')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #fff09a;
        }

        .sidebar {
            min-height: calc(100vh - 50px);
            background: #613918;
        }

        .sidebar a {
            display: block;
            padding: 9px 12px;
            color: #f8f8f8;
            text-decoration: none;
            border-radius: 4px;
        }

        .sidebar a:hover {
            background: #7a5817;
        }

        .content {
            padding: 24px;
        }

        .table {
            background: white;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark px-3" style="background-color: #815b2e;">
    <span class="navbar-brand">APLIKASI PARKIR</span>

    <div class="text-light d-flex align-items-center gap-3">
        <span>
            {{ auth()->user()->nama_lengkap }}
            ({{ ucfirst(auth()->user()->role) }})
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm btn-outline-light">Keluar</button>
        </form>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <aside class="col-md-2 sidebar p-3">

            @if (auth()->user()->role === 'admin')

                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.user.index') }}">Data User</a>
                <a href="{{ route('admin.tarif.index') }}">Tarif Parkir</a>
                <a href="{{ route('admin.area.index') }}">Area Parkir</a>
                <a href="{{ route('admin.kendaraan.index') }}">Kendaraan</a>
                <a href="{{ route('admin.log.index') }}">Log Aktivitas</a>

            @elseif (auth()->user()->role === 'petugas')

                <a href="{{ route('petugas.dashboard') }}">Dashboard</a>
                <a href="{{ route('petugas.transaksi.index') }}">Transaksi Parkir</a>

            @else

                <a href="{{ route('owner.rekap.index') }}">Laporan</a>

            @endif

        </aside>

        <main class="col-md-10 content">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </main>

    </div>
</div>

</body>
</html>
