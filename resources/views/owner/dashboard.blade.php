<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner - PARKIR APP</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f5f7;
            color: #0aacdd;
        }

        .sidebar {
            position: fixed;
            width: 235px;
            height: 100vh;
            background: #6191cf;
            color: white;
            padding: 25px 16px;
        }

        .brand {
            font-size: 21px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #c597ce;
            font-size: 12px;
            margin-bottom: 30px;
        }

        .menu {
            display: block;
            padding: 12px;
            margin: 7px 0;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .menu:hover, .active {
            background: rgb(73, 168, 245);
        }

        .logout {
            position: absolute;
            bottom: 25px;
            left: 16px;
            right: 16px;
        }

        .logout button {
            width: 100%;
            padding: 11px;
            background: #266ea9;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .main {
            margin-left: 235px;
            padding: 30px;
        }

        .header {
            background: white;
            padding: 22px;
            border-radius: 8px;
            margin-bottom: 22px;
        }

        .header h1 {
            margin: 0 0 8px;
            font-size: 25px;
        }

        .header p {
            margin: 0;
            color: #e7a5ce;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .card {
            background: white;
            padding: 23px;
            border-radius: 8px;
            border-left: 4px solid #f2c3f7;
        }

        .card h3 {
            font-size: 14px;
            color: #5bacdb;
            margin: 0 0 15px;
        }

        .angka {
            font-size: 27px;
            font-weight: bold;
        }

        .info {
            margin-top: 22px;
            background: white;
            padding: 22px;
            border-radius: 8px;
            line-height: 1.7;
        }

        .laporan {
            display: inline-block;
            margin-top: 10px;
            padding: 11px 15px;
            background: #e7c5e4;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        @media (max-width: 800px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .logout {
                position: static;
                margin-top: 20px;
            }

            .main {
                margin-left: 0;
                padding: 15px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="brand">PARKIR APP</div>
    <div class="subtitle">Sistem Informasi Parkir</div>

    <a href="{{ route('owner.dashboard') }}" class="menu active">
        Dashboard
    </a>

    <a href="{{ route('owner.rekap.index') }}" class="menu">
        Laporan Transaksi
    </a>

    <form action="{{ route('logout') }}" method="POST" class="logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
</aside>

<main class="main">
    <section class="header">
        <h1>Dashboard Owner</h1>
        <p>Selamat datang, {{ auth()->user()->nama_lengkap }}.</p>
        <p>Berikut ringkasan aktivitas parkir.</p>
    </section>

    <section class="cards">
        <div class="card">
            <h3>Total Transaksi</h3>
            <div class="angka">{{ $totalTransaksi ?? 0 }}</div>
        </div>

        <div class="card">
            <h3>Kendaraan Sedang Parkir</h3>
            <div class="angka">{{ $kendaraanParkir ?? 0 }}</div>
        </div>

        <div class="card">
            <h3>Pendapatan Hari Ini</h3>
            <div class="angka">
                Rp {{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}
            </div>
        </div>
    </section>

    <section class="info">
        <h3>Informasi</h3>
        <p>
            Halaman ini digunakan Owner untuk memantau transaksi dan
            pendapatan parkir. Owner hanya memiliki akses melihat data.
        </p>

        <a href="{{ route('owner.rekap.index') }}" class="laporan">
            Lihat Laporan Transaksi
        </a>
    </section>
</main>

</body>
</html>
