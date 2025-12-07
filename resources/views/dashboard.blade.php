<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        .stat-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        .navbar-custom {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-4">
                    <h4 class="text-white mb-4">
                        <i class="bi bi-shop"></i> E-Business
                    </h4>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a class="nav-link" href="{{ route('products.index') }}">
                        <i class="bi bi-box-seam me-2"></i> Produk
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-people me-2"></i> Pelanggan
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-cart me-2"></i> Pesanan
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-graph-up me-2"></i> Laporan
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-gear me-2"></i> Pengaturan
                    </a>
                    
                    <hr class="text-white mx-3">
                    
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person-circle me-2"></i> Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-0">
                <!-- Top Navbar -->
                <nav class="navbar navbar-custom navbar-light">
                    <div class="container-fluid">
                        <span class="navbar-text">
                            <i class="bi bi-calendar3 me-2"></i>
                            {{ now()->locale('id')->translatedFormat('l, d F Y') }}
                        </span>
                        <div class="d-flex align-items-center">
                            <span class="me-3">
                                <i class="bi bi-person-circle fs-5 me-2"></i>
                                <strong>{{ Auth::user()->name }}</strong>
                            </span>
                        </div>
                    </div>
                </nav>

                <!-- Content -->
                <div class="p-4">
                    <!-- Welcome Card -->
                    <div class="welcome-card">
                        <h2 class="mb-2">👋 Selamat Datang, {{ Auth::user()->name }}!</h2>
                        <p class="mb-0 opacity-75">Kelola toko online Anda dengan mudah dari dashboard ini</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted mb-1">Total Produk</p>
                                            <h3 class="mb-0">{{ $totalProducts }}</h3>
                                        </div>
                                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                                            <i class="bi bi-box-seam"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted mb-1">Total Stok</p>
                                            <h3 class="mb-0">{{ number_format($totalStock) }}</h3>
                                        </div>
                                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-stack"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted mb-1">Stok Menipis</p>
                                            <h3 class="mb-0">{{ $lowStock }}</h3>
                                        </div>
                                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                            <i class="bi bi-exclamation-triangle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted mb-1">Total Nilai</p>
                                            <h3 class="mb-0">Rp {{ number_format($totalValue / 1000000, 1) }}M</h3>
                                        </div>
                                        <div class="stat-icon bg-info bg-opacity-10 text-info">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">
                                        <i class="bi bi-lightning-charge text-warning"></i> Aksi Cepat
                                    </h5>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                                            <i class="bi bi-plus-circle me-2"></i> Tambah Produk
                                        </a>
                                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                                            <i class="bi bi-list-ul me-2"></i> Lihat Semua Produk
                                        </a>
                                        <a href="#" class="btn btn-outline-success">
                                            <i class="bi bi-file-earmark-text me-2"></i> Buat Laporan
                                        </a>
                                        <a href="#" class="btn btn-outline-info">
                                            <i class="bi bi-people me-2"></i> Kelola Pelanggan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Products -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="card-title mb-0">
                                            <i class="bi bi-clock-history text-primary"></i> Produk Terbaru
                                        </h5>
                                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">
                                            Lihat Semua
                                        </a>
                                    </div>

                                    @if($recentProducts->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Gambar</th>
                                                        <th>Nama</th>
                                                        <th>Harga</th>
                                                        <th>Stok</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($recentProducts as $product)
                                                        <tr>
                                                            <td>
                                                                @if($product->image)
                                                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                                                         class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                                                @else
                                                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                                                         style="width: 50px; height: 50px;">
                                                                        <i class="bi bi-image text-white"></i>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <strong>{{ $product->name }}</strong><br>
                                                                <small class="text-muted">{{ Str::limit($product->description, 30) }}</small>
                                                            </td>
                                                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                                            <td>
                                                                <span class="badge bg-{{ $product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning' : 'danger') }}">
                                                                    {{ $product->stock }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('products.show', $product) }}" 
                                                                   class="btn btn-sm btn-info">
                                                                    <i class="bi bi-eye"></i>
                                                                </a>
                                                                <a href="{{ route('products.edit', $product) }}" 
                                                                   class="btn btn-sm btn-warning">
                                                                    <i class="bi bi-pencil"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <i class="bi bi-inbox fs-1 text-muted"></i>
                                            <p class="text-muted mt-3">Belum ada produk. Tambahkan produk pertama Anda!</p>
                                            <a href="{{ route('products.create') }}" class="btn btn-primary mt-2">
                                                <i class="bi bi-plus-circle me-2"></i> Tambah Produk
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>