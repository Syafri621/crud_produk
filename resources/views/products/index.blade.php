@extends('layouts.main')

@section('title', 'Manajemen Produk')

@section('content')
<div class="container py-5">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-dark m-0">Katalog Produk</h2>
            <p class="text-muted">Kelola inventaris barang Anda dengan efisien</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                <i class="bi bi-plus-circle me-2"></i>Tambah Produk Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">No</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Produk</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Harga</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted text-center">Stok</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $index => $product)
                            <tr>
                                <td class="ps-4 text-muted fw-medium">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 position-relative">
                                            @if($product->image)
                                                <img src="{{ asset('images/' . $product->image) }}" 
                                                     alt="{{ $product->name }}" 
                                                     class="rounded-3 shadow-sm border object-fit-cover" 
                                                     style="width: 64px; height: 64px;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center border rounded-3" 
                                                     style="width: 64px; height: 64px;">
                                                    <i class="bi bi-image text-muted fs-4"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $product->name }}</div>
                                            <div class="text-muted small">ID: #PROD-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-center">
                                    @if($product->stock <= 5)
                                        <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">
                                            Kritis: {{ $product->stock }}
                                        </span>
                                    @else
                                        <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                            Tersedia: {{ $product->stock }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('products.edit', $product->id) }}" 
                                        class="btn btn-white btn-sm border shadow-sm rounded-3 text-warning px-3">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <button type="button" 
                                                class="btn btn-white btn-sm border shadow-sm rounded-3 text-danger px-3"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal"
                                                data-id="{{ $product->id }}"
                                                data-name="{{ $product->name }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="bi bi-inbox text-muted display-1"></i>
                                        <p class="mt-3 fs-5 text-muted">Belum ada data produk tersedia.</p>
                                        <a href="{{ route('products.create') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                            Tambah Sekarang
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pb-4">
                <div class="mb-3">
                    <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                </div>
                <h4 class="fw-bold">Hapus Produk?</h4>
                <p class="text-muted">Apakah Anda yakin ingin menghapus <strong id="productName"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Ya, Hapus Produk</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteModal = document.getElementById('deleteModal');
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', function (event) {
                // Tombol yang diklik
                const button = event.relatedTarget;
                
                // Ambil data dari atribut data-id dan data-name
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                
                // Update isi teks modal
                const productNameSpan = deleteModal.querySelector('#productName');
                const deleteForm = deleteModal.querySelector('#deleteForm');
                
                productNameSpan.textContent = name;
                
                // Set Action Form secara dinamis ke route destroy
                // Sesuaikan '/products/' dengan prefix URL Anda jika berbeda
                deleteForm.action = '/products/' + id;
            });
        }
    });
</script>
@endpush

<style>
    body { background-color: #f8fbff; }
    .table thead th { 
        border-top: none; 
        background-color: #fcfcfc;
        letter-spacing: 0.5px;
    }
    .table tbody tr { transition: all 0.2s ease; }
    .table tbody tr:hover { background-color: #f1f5f9; }
    .btn-white {
        background: #ffffff;
        color: #64748b;
    }
    .btn-white:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }
    .badge {
        font-weight: 600;
        font-size: 0.75rem;
    }
    .card { border-radius: 1.25rem; }
    .object-fit-cover { object-fit: cover; }
    
    /* Animasi Modal */
    .modal.fade .modal-dialog {
        transform: scale(0.8);
        transition: transform 0.2s ease-out;
    }
    .modal.show .modal-dialog {
        transform: scale(1);
    }
</style>
@endsection