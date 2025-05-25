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
        Schema::create("document_statuses", function (Blueprint $table) {
            $table->id("status_id"); // Match previous schema name
            $table->string("status_name")->unique();
            $table->text("description")->nullable();
            $table->timestamps();

         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("document_statuses");
    }
};
