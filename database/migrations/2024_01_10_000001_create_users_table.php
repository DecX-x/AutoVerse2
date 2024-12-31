<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_image')->nullable();
            $table->text('address')->nullable();
            // add column seller, enumerate false, pending and approved. false as default
            $table->enum('seller', ['false', 'pending', 'approved'])->default('false');
            // add column admin, enumerate false and true. false as default
            $table->enum('admin', ['false', 'true'])->default('false');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};