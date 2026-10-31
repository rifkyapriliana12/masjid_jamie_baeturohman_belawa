<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_masjid');
            $table->string('alamat', 500);
            $table->string('telepon', 50)->nullable();
            $table->string('email')->nullable();
            $table->string('rekening_infaq', 100)->nullable();
            $table->string('nama_bank', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
