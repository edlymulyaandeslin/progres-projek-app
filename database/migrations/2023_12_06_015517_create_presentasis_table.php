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
        Schema::create('presentasis', function (Blueprint $table) {
            $table->ulid('id');
            $table->foreignUlid('user_id');
            $table->foreignUlid('judul_id');
            $table->string('tanggal')->default('');
            $table->string('jam')->default('');
            $table->string('status')->default('diajukan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presentasis');
    }
};
