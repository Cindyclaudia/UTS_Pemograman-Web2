<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #1a1a2e, #16213e, #0f3460);
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px 0;
            z-index: 100;
        }
        .sidebar-brand {
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            padding: 15px 25px 30px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar-brand i {
            color: #e94560;
            font-size: 22px;
        }
        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
            margin: 0;
        }
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 25px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s;
            font-size: 14px;
        }
        .sidebar-menu li a:hover, .sidebar-menu li a.active {
            background: rgba(233,69,96,0.2);
            color: #fff;
            border-left: 3px solid #e94560;
        }
        .sidebar-menu li a i { width: 20px; }
        .main-content {
            margin-left: 250px;
            padding: 0;
        }
        .topbar {
            background: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .topbar h5 { margin: 0; color: #1a1a2e; font-weight: 600; }
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #e94560, #c62a47);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
        }
        .btn-logout {
            background: linear-gradient(135deg, #e94560, #c62a47);
            border: none;
            color: #fff;
            padding: 7px 18px;
            border-radius: 8px;
            font-size: 13px;
            transition: all 0.3s;
        }
        .btn-logout:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(233,69,96,0.4);
            color: #fff;
        }
        .content-area { padding: 30px; }
        .welcome-banner {
            background: linear-gradient(135deg, #1a1a2e, #0f3460);
            border-radius: 15px;
            padding: 30px;
            color: #fff;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }
        .welcome-banner::after {
            content: '\f19d';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 30px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 80px;
            color: rgba(255,255,255,0.05);
        }
        .welcome-banner h4 { font-weight: 700; margin-bottom: 5px; }
        .welcome-banner p { color: rgba(255,255,255,0.6); margin: 0; }
        .stat-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s;
            text-decoration: none;
            display: block;
            border: none;
            height: 100%;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fff;
            margin-bottom: 15px;
        }
        .stat-card h3 { font-size: 28px; font-weight: 700; color: #1a1a2e; margin: 0; }
        .stat-card p { color: #888; margin: 5px 0 0; font-size: 14px; }
        .menu-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 20px;
            color: #1a1a2e;
        }
        .menu-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            color: #1a1a2e;
        }
        .menu-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #fff;
            flex-shrink: 0;
        }
        .menu-card h6 { font-weight: 600; margin: 0 0 3px; }
        .menu-card small { color: #888; }
        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-graduation-cap"></i>
            Sistem Akademik
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="{{ route('jurusan.index') }}"><i class="fas fa-building"></i> Jurusan</a></li>
            <li><a href="{{ route('mahasiswa.index') }}"><i class="fas fa-user-graduate"></i> Mahasiswa</a></li>
            <li><a href="{{ route('matakuliah.index') }}"><i class="fas fa-book"></i> Matakuliah</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <h5><i class="fas fa-home me-2 text-danger"></i>Dashboard</h5>
            <div class="user-info">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <span style="font-size:14px; color:#555;">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn-logout"><i class="fas fa-sign-out-alt me-1"></i>Logout</button>
                </form>
            </div>
        </div>

        <!-- Content -->
        <div class="content-area">
            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <h4>Selamat Datang, {{ Auth::user()->name }}! 👋</h4>
                <p>Universitas Teknologi Bandung — Sistem Akademik Sederhana</p>
            </div>

            <!-- Stats -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <a href="{{ route('jurusan.index') }}" class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #e94560, #c62a47);">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3>{{ \App\Models\Jurusan::count() }}</h3>
                        <p>Total Jurusan</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('mahasiswa.index') }}" class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #0f3460, #1a6da8);">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3>{{ \App\Models\Mahasiswa::count() }}</h3>
                        <p>Total Mahasiswa</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('matakuliah.index') }}" class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #f5a623, #e8890c);">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3>{{ \App\Models\Matakuliah::count() }}</h3>
                        <p>Total Matakuliah</p>
                    </a>
                </div>
            </div>

            <!-- Menu -->
            <p class="section-title">Menu Utama</p>
            <div class="row g-3">
                <div class="col-md-4">
                    <a href="{{ route('jurusan.index') }}" class="menu-card">
                        <div class="menu-icon" style="background: linear-gradient(135deg, #e94560, #c62a47);">
                            <i class="fas fa-building"></i>
                        </div>
                        <div>
                            <h6>Kelola Jurusan</h6>
                            <small>Tambah, edit, hapus jurusan</small>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('mahasiswa.index') }}" class="menu-card">
                        <div class="menu-icon" style="background: linear-gradient(135deg, #0f3460, #1a6da8);">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div>
                            <h6>Kelola Mahasiswa</h6>
                            <small>Tambah, edit, hapus mahasiswa</small>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('matakuliah.index') }}" class="menu-card">
                        <div class="menu-icon" style="background: linear-gradient(135deg, #f5a623, #e8890c);">
                            <i class="fas fa-book"></i>
                        </div>
                        <div>
                            <h6>Kelola Matakuliah</h6>
                            <small>Tambah, edit, hapus matakuliah</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>