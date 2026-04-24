<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jurusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .sidebar {
            width: 250px; height: 100vh;
            background: linear-gradient(180deg, #1a1a2e, #16213e, #0f3460);
            position: fixed; top: 0; left: 0; padding: 20px 0; z-index: 100;
        }
        .sidebar-brand {
            color: #fff; font-size: 18px; font-weight: 700;
            padding: 15px 25px 30px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar-brand i { color: #e94560; font-size: 22px; }
        .sidebar-menu { list-style: none; padding: 20px 0; margin: 0; }
        .sidebar-menu li a {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 25px; color: rgba(255,255,255,0.7);
            text-decoration: none; transition: all 0.3s; font-size: 14px;
        }
        .sidebar-menu li a:hover, .sidebar-menu li a.active {
            background: rgba(233,69,96,0.2); color: #fff;
            border-left: 3px solid #e94560;
        }
        .sidebar-menu li a i { width: 20px; }
        .main-content { margin-left: 250px; }
        .topbar {
            background: #fff; padding: 15px 30px;
            display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .topbar h5 { margin: 0; color: #1a1a2e; font-weight: 600; }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .user-avatar {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, #e94560, #c62a47);
            border-radius: 50%; display: flex; align-items: center;
            justify-content: center; color: #fff; font-weight: 700;
        }
        .btn-logout {
            background: linear-gradient(135deg, #e94560, #c62a47);
            border: none; color: #fff; padding: 7px 18px;
            border-radius: 8px; font-size: 13px;
        }
        .btn-logout:hover { color: #fff; }
        .content-area { padding: 30px; }
        .form-card {
            background: #fff; border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden;
            max-width: 600px;
        }
        .form-card-header {
            background: linear-gradient(135deg, #f5a623, #e8890c);
            padding: 20px 25px;
        }
        .form-card-header h5 { color: #fff; margin: 0; font-weight: 600; }
        .form-body { padding: 25px; }
        .form-label { font-weight: 600; color: #444; font-size: 14px; }
        .form-control, .form-select {
            border-radius: 10px; border: 1px solid #e0e0e0;
            padding: 10px 15px; font-size: 14px; transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #f5a623;
            box-shadow: 0 0 0 0.2rem rgba(245,166,35,0.15);
        }
        .btn-update {
            background: linear-gradient(135deg, #f5a623, #e8890c);
            border: none; color: #fff; padding: 10px 25px;
            border-radius: 10px; font-size: 14px; font-weight: 600;
        }
        .btn-update:hover { color: #fff; }
        .btn-batal {
            background: #f0f2f5; border: none; color: #555;
            padding: 10px 25px; border-radius: 10px;
            font-size: 14px; text-decoration: none;
        }
        .btn-batal:hover { background: #e0e0e0; color: #333; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-graduation-cap"></i> Sistem Akademik
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="{{ route('jurusan.index') }}" class="active"><i class="fas fa-building"></i> Jurusan</a></li>
            <li><a href="{{ route('mahasiswa.index') }}"><i class="fas fa-user-graduate"></i> Mahasiswa</a></li>
            <li><a href="{{ route('matakuliah.index') }}"><i class="fas fa-book"></i> Matakuliah</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="topbar">
            <h5><i class="fas fa-edit me-2 text-warning"></i>Edit Jurusan</h5>
            <div class="user-info">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <span style="font-size:14px; color:#555;">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn-logout"><i class="fas fa-sign-out-alt me-1"></i>Logout</button>
                </form>
            </div>
        </div>

        <div class="content-area">
            <div class="form-card">
                <div class="form-card-header">
                    <h5><i class="fas fa-edit me-2"></i>Form Edit Jurusan</h5>
                </div>
                <div class="form-body">
                    @if($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4">
                            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif
                    <form action="{{ route('jurusan.update', $jurusan->id_jurusan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-building me-2 text-warning"></i>Nama Jurusan</label>
                            <input type="text" name="nama_jurusan" class="form-control" value="{{ $jurusan->nama_jurusan }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-star me-2 text-warning"></i>Akreditasi</label>
                            <select name="akreditasi" class="form-select" required>
                                <option value="">-- Pilih Akreditasi --</option>
                                <option value="A" {{ $jurusan->akreditasi == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ $jurusan->akreditasi == 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ $jurusan->akreditasi == 'C' ? 'selected' : '' }}>C</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn-update"><i class="fas fa-save me-2"></i>Update</button>
                            <a href="{{ route('jurusan.index') }}" class="btn-batal"><i class="fas fa-arrow-left me-2"></i>Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>