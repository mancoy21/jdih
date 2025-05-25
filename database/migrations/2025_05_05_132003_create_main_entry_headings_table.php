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
        Schema::create("main_entry_headings", function (Blueprint $table) {
            $table->id("heading_id"); // Match previous schema name
            $table->string("heading_name")->unique();
            $table->text("description")->nullable();
            $table->timestamps();

        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("main_entry_headings");
    }
};
