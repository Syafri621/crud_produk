@extends('layouts.main')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h2 class="mb-4">Tambah Produk Baru</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('products.store') }}" class="needs-validation" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control form-control-lg" id="name" name="name" 
                           value="{{ old('name') }}" required placeholder="Masukkan nama produk">
                </div>
                
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light">Rp</span>
                        <input type="text" class="form-control" id="price" name="price" 
                               value="{{ old('price') }}" 
                               required placeholder="Contoh: 1500000"
                               onkeyup="formatHarga(this)">
                    </div>
                    <div class="form-text">Masukkan angka, otomatis akan diformat dengan titik pemisah ribuan</div>
                </div>
                
                <div class="mb-3">
                    <label for="stock" class="form-label">Stok</label>
                    <input type="number" class="form-control form-control-lg" id="stock" name="stock" 
                           value="{{ old('stock') }}" min="0" required placeholder="Masukkan jumlah stok">
                </div>
                
                <div class="mb-4">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" 
                              rows="3" style="resize: none;" 
                              placeholder="Masukkan deskripsi produk">{{ old('description') }}</textarea>
                </div>
                
                <hr class="my-4">
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk format harga dengan pemisah ribuan
    function formatHarga(input) {
        // Hapus semua karakter selain angka
        let value = input.value.replace(/[^\d]/g, '');
        
        // Format dengan titik sebagai pemisah ribuan
        if (value.length > 0) {
            // Konversi ke angka
            const number = parseInt(value);
            // Format dengan titik pemisah ribuan (format Indonesia)
            value = number.toLocaleString('id-ID');
        }
        
        // Set nilai kembali ke input
        input.value = value;
    }
    
    // Format harga saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const hargaInput = document.getElementById('price');
        if (hargaInput.value) {
            // Pastikan sudah dalam format yang benar
            let value = hargaInput.value.replace(/[^\d]/g, '');
            if (value.length > 0) {
                const number = parseInt(value);
                hargaInput.value = number.toLocaleString('id-ID');
            }
        }
    });
    
    // Validasi form
    (function() {
        'use strict'
        
        var forms = document.querySelectorAll('.needs-validation')
        
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
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
    .form-control-lg {
        font-size: 1.1rem;
        padding: 0.75rem 1rem;
    }
    
    .btn-lg {
        padding: 0.75rem 2rem;
        font-size: 1.1rem;
    }
    
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }
    
    .form-text {
        margin-top: 0.25rem;
        color: #6c757d;
        font-size: 0.875rem;
    }
    
    .card {
        border: none;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        border-radius: 10px;
    }
    
    .card-body {
        padding: 2rem;
    }
    
    hr {
        opacity: 0.3;
    }
    
    .form-control::placeholder {
        color: #adb5bd;
        font-size: 1rem;
    }
</style>
@endsection