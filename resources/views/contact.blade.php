@extends('layouts.main')

@section('title', 'Kontak')

@section('content')
<div class="card">
    <div class="card-body">
        <h4>Kontak</h4>
        <p>Nama: {{ $name }}</p>
        <p>Email: {{ $email }}</p>
    </div>
</div>
@endsection