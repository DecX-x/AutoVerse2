create_products_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->decimal('price', 12, 2);
            $table->float('rating')->default(0);
            $table->integer('reviews_count')->default(0);
            $table->text('description');
            $table->string('badge')->nullable();
            $table->string('badge_color')->nullable();
            $table->boolean('free_shipping')->default(false);
            $table->string('image');
            $table->integer('stock')->default(0);
            $table->json('features')->nullable();
            $table->json('specifications')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};