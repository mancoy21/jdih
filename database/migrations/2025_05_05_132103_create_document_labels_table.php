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
        Schema::create("document_labels", function (Blueprint $table) {
            // Use Laravel convention for pivot table names (singular, alphabetical order)
            // However, sticking to previous schema name for consistency here.
            $table->unsignedBigInteger("document_id");
            $table->unsignedBigInteger("label_id");

            // Define composite primary key
            $table->primary(["document_id", "label_id"]);

            // Foreign key constraints (added in a separate migration)
            // $table->foreign("document_id")->references("document_id")->on("documents")->onDelete("cascade");
            // $table->foreign("label_id")->references("label_id")->on("labels")->onDelete("cascade");

            $table->timestamps(); // Optional: track when relationship was added/updated

        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("document_labels");
    }
};
