<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class create_featured_product extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('featured_product', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('review');
            $table->string('harga');
            $table->enum('shipping', ['Free shipping', 'Paid shipping']);
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('featured_product');
    }
};
