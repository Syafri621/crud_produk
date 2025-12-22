@extends('layouts.main')

@section('title', 'Edit Produk - ProManager')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-pencil-square text-warning fs-3"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-1">Edit Produk</h2>
                            <p class="text-muted mb-0">Perbarui informasi untuk produk: <strong>{{ $product->name }}</strong></p>
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4">
                            <ul class="mb-0 small">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('products.update', $product->id) }}" class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-12">
                                <label for="name" class="form-label fw-semibold">Nama Produk</label>
                                <input type="text" class="form-control shadow-none" id="name" name="name" 
                                       value="{{ old('name', $product->name) }}" required placeholder="Masukkan nama produk">
                                <div class="invalid-feedback">Nama produk wajib diisi.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="price" class="form-label fw-semibold">Harga Jual</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">Rp</span>
                                    <input type="text" class="form-control shadow-none border-start-0" id="price" name="price" 
                                           value="{{ old('price', number_format($product->price, 0, ',', '.')) }}" required 
                                           onkeyup="formatHarga(this)">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="stock" class="form-label fw-semibold">Jumlah Stok</label>
                                <input type="number" class="form-control shadow-none" id="stock" name="stock" 
                                       value="{{ old('stock', $product->stock) }}" min="0" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Foto Produk</label>
                                <div class="row align-items-center border rounded-4 p-4 bg-light bg-opacity-50 g-3">
                                    <div class="col-md-4 text-center border-end-md">
                                        <p class="small text-muted mb-2">Foto Saat Ini</p>
                                        @if($product->image)
                                            <img id="image-preview" src="{{ asset('images/' . $product->image) }}" 
                                                 alt="Preview" class="img-thumbnail shadow-sm rounded-3 object-fit-cover" 
                                                 style="width: 150px; height: 150px;">
                                        @else
                                            <div id="image-placeholder" class="bg-white rounded-3 d-flex align-items-center justify-content-center border mx-auto" style="width: 150px; height: 150px;">
                                                <i class="bi bi-image text-muted fs-1"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-8 ps-md-4">
                                        <label for="image" class="btn btn-outline-primary btn-sm rounded-pill px-4 mb-2">
                                            <i class="bi bi-upload me-2"></i>Ganti Foto Baru
                                        </label>
                                        <input type="file" class="form-control d-none" id="image" name="image" accept="image/*">
                                        <p class="small text-muted mb-0">Biarkan kosong jika tidak ingin mengganti foto.</p>
                                        <p class="x-small text-muted mt-1" style="font-size: 0.75rem;">Format: JPG, PNG, JPEG (Maks. 2MB)</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label fw-semibold">Deskripsi Produk</label>
                                <textarea class="form-control shadow-none" id="description" name="description" 
                                          rows="4" style="resize: none;" 
                                          placeholder="Tuliskan detail spesifikasi produk...">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>

                        <hr class="my-5 opacity-25">

                        <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                            <a href="{{ route('products.index') }}" class="btn btn-light btn-lg rounded-3 px-4 text-muted">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 px-5 shadow-sm">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Format Harga ke Rupiah
    function formatHarga(input) {
        let value = input.value.replace(/[^\d]/g, '');
        if (value.length > 0) {
            const number = parseInt(value);
            value = number.toLocaleString('id-ID');
        }
        input.value = value;
    }

    // Live Preview saat memilih gambar baru
    document.getElementById('image').addEventListener('change', function(e) {
        const previewImage = document.getElementById('image-preview');
        const placeholder = document.getElementById('image-placeholder');
        
        const [file] = this.files;
        if (file) {
            if (previewImage) {
                previewImage.src = URL.createObjectURL(file);
            } else if (placeholder) {
                // Jika sebelumnya tidak ada gambar, ganti placeholder jadi img
                placeholder.outerHTML = `<img id="image-preview" src="${URL.createObjectURL(file)}" class="img-thumbnail shadow-sm rounded-3 object-fit-cover" style="width: 150px; height: 150px;">`;
            }
        }
    });

    // Validasi Form Bootstrap
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<style>
    .card { border-radius: 1.25rem !important; }
    .form-control, .input-group-text {
        border-color: #e2e8f0;
        padding: 0.75rem 1rem;
    }
    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }
    .object-fit-cover { object-fit: cover; }
    @media (min-width: 768px) {
        .border-end-md { border-end: 1px solid #e2e8f0 !important; }
    }
</style>
@endsection