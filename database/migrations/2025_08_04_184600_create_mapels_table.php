<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mapels', function (Blueprint $table) {
            $table->id();
            // $table->string('user_id');
            $table->string('nama');
            $table->enum('kelompok_kelas', ['1-2', '1-6', '1-3', '3-6', '4B', '5B', '6B']);
            // $table->string('status'); // terinput atau tidak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapels');
    }
};
