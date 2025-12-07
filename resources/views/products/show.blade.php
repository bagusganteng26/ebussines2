@extends('layouts.admin')

@section('title', 'Detail Produk')

@section('content')
<div class="mb-4">
    <h2><i class="bi bi-eye text-info"></i> Detail Produk</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card stat-card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Informasi Produk</h5>
            </div>
            <div class="card-body">
                @if($product->image)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             class="img-fluid rounded shadow" style="max-height: 400px;">
                    </div>
                @endif

                <table class="table table-borderless">
                    <tr>
                        <th width="30%" class="text-muted">ID Produk</th>
                        <td><strong>{{ $product->id }}</strong></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Nama Produk</th>
                        <td><strong>{{ $product->name }}</strong></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Deskripsi</th>
                        <td>{{ $product->description ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Harga</th>
                        <td><h4 class="text-primary mb-0">Rp {{ number_format($product->price, 0, ',', '.') }}</h4></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Stok</th>
                        <td>
                            <span class="badge bg-{{ $product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning' : 'danger') }} fs-6">
                                {{ $product->stock }} unit
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">Total Nilai</th>
                        <td>
                            <strong>Rp {{ number_format($product->price * $product->stock, 0, ',', '.') }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">Dibuat</th>
                        <td>{{ $product->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Terakhir Diupdate</th>
                        <td>{{ $product->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>

                <hr>

                <div class="d-flex gap-2">
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i> Edit
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i> Kembali
                    </a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-2"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <h6 class="card-title"><i class="bi bi-bar-chart text-primary"></i> Statistik</h6>
                <div class="mt-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Status Stok:</span>
                        @if($product->stock > 10)
                            <span class="badge bg-success">Aman</span>
                        @elseif($product->stock > 0)
                            <span class="badge bg-warning">Menipis</span>
                        @else
                            <span class="badge bg-danger">Habis</span>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Kategori:</span>
                        <span class="badge bg-secondary">Umum</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection