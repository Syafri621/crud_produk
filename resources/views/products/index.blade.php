@extends('layouts.main')

@section('title', 'Daftar Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Produk</h2>
    <a href="#" class="btn btn-primary btn-sm disabled">+ Tambah Produk (belum aktif)</a>
</div>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->description }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data produk.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection