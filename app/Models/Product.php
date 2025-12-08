<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Nama tabel (jika berbeda)
    protected $table = 'products';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'name',
        'price',
        'stock',
        'description'
    ];
}