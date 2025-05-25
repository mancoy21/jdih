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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title_part_1')->nullable(); // Bagian pertama title (misalnya "Selamat Datang di JDIH")
            $table->string('title_part_2')->nullable(); // Bagian kedua title (misalnya "Kemenkes Biro Hukum")
            $table->text('description')->nullable();    // Deskripsi slider
            $table->string('image_url')->nullable();    // Path ke file gambar di storage lokal
            $table->string('button_label_1')->nullable();
            $table->string('button_link_1')->nullable();
            $table->string('button_label_2')->nullable();
            $table->string('button_link_2')->nullable();
            $table->integer('order')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
