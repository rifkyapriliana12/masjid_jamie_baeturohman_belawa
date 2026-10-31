<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('khutbahs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('khatib');
            $table->string('imam');
            $table->string('muadzin');
            $table->string('tema')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('khutbahs');
    }
};
