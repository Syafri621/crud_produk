@extends('layouts.main')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-box-seam text-primary fs-3"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-1">Tambah Produk Baru</h2>
                            <p class="text-muted mb-0">Lengkapi detail informasi produk inventaris Anda</p>
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

                    <form method="POST" action="{{ route('products.store') }}" class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <div class="col-12">
                                <label for="name" class="form-label fw-semibold">Nama Produk</label>
                                <input type="text" class="form-control shadow-none" id="name" name="name" 
                                       value="{{ old('name') }}" required placeholder="Contoh: MacBook Pro M2 2023">
                                <div class="invalid-feedback">Nama produk wajib diisi.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="price" class="form-label fw-semibold">Harga Jual</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">Rp</span>
                                    <input type="text" class="form-control shadow-none border-start-0" id="price" name="price" 
                                           value="{{ old('price') }}" required placeholder="0"
                                           onkeyup="formatHarga(this)">
                                </div>
                                <div class="form-text small text-muted italic">Format ribuan otomatis terpasang.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="stock" class="form-label fw-semibold">Jumlah Stok</label>
                                <input type="number" class="form-control shadow-none" id="stock" name="stock" 
                                       value="{{ old('stock') }}" min="0" required placeholder="0">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Foto Produk</label>
                                <div class="border rounded-3 p-4 text-center bg-light bg-opacity-50 border-dashed mb-2">
                                    <div id="preview-container" class="mb-3 d-none">
                                        <img id="image-preview" src="#" alt="Preview" class="img-thumbnail shadow-sm" style="max-height: 200px;">
                                    </div>
                                    <div id="upload-placeholder">
                                        <i class="bi bi-cloud-arrow-up fs-1 text-muted"></i>
                                        <p class="small text-muted mt-2">Pilih file gambar untuk melihat preview</p>
                                    </div>
                                    <input type="file" class="form-control d-none" id="image" name="image" accept="image/*" required>
                                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-4" onclick="document.getElementById('image').click()">
                                        Pilih Gambar
                                    </button>
                                </div>
                                <div class="form-text small">Mendukung: JPG, PNG, JPEG (Maks. 2MB)</div>
                                @error('image')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label fw-semibold">Deskripsi Produk</label>
                                <textarea class="form-control shadow-none" id="description" name="description" 
                                          rows="4" style="resize: none;" 
                                          placeholder="Tuliskan detail spesifikasi produk...">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <hr class="my-5 opacity-25">

                        <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                            <a href="{{ route('products.index') }}" class="btn btn-light btn-lg rounded-3 px-4">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 px-5 shadow-sm">
                                <i class="bi bi-check2-circle me-2"></i>Simpan Produk
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

    // Live Preview Gambar
    document.getElementById('image').addEventListener('change', function(e) {
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('image-preview');
        const placeholder = document.getElementById('upload-placeholder');
        
        const [file] = this.files;
        if (file) {
            previewImage.src = URL.createObjectURL(file);
            previewContainer.classList.remove('d-none');
            placeholder.classList.add('d-none');
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
    body { background-color: #f8fbff; }
    .card { border-radius: 1.25rem !important; }
    .form-control, .input-group-text {
        border-color: #e2e8f0;
        padding: 0.75rem 1rem;
    }
    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }
    .border-dashed { border-style: dashed !important; border-width: 2px !important; }
    .btn-primary { background-color: #4f46e5; border-color: #4f46e5; }
    .btn-primary:hover { background-color: #4338ca; border-color: #4338ca; }
    .btn-lg { font-size: 1rem; font-weight: 600; }
</style>
@endsection