<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();                              // kolom ID auto increment
            $table->string('name');                    // kolom nama produk
            $table->decimal('price', 10, 2);           // kolom harga produk
            $table->text('description')->nullable();   // kolom deskripsi, boleh kosong
            $table->integer('stock')->nullable();      // kolom stok, boleh kosong
            $table->string('image')->nullable();       // kolom image, boleh kosong
            $table->timestamps();                      // kolom created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
