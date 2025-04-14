<?php

// database/migrations/2024_04_12_000002_create_pencapaian_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pencapaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->integer('jumlah_halaman');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pencapaian');
    }
};

