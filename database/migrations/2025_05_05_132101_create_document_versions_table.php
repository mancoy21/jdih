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
        Schema::create("document_versions", function (Blueprint $table) {
            $table->id("version_id");
            $table->unsignedBigInteger("document_id")->index(); // Foreign key to the main document
            $table->integer("version_number")->default(1);
            
            // Mirror relevant fields from the documents table to store historical state
            $table->string("title");
            $table->string("document_number")->nullable();
            $table->integer("document_year")->nullable();
            $table->text("description")->nullable();
            $table->date("issuance_date")->nullable();
            $table->date("announcement_date")->nullable();
            $table->unsignedBigInteger("type_id");
            $table->unsignedBigInteger("status_id");
            $table->unsignedBigInteger("heading_id")->nullable();
            $table->string("file_path")->nullable(); // Path to the specific version's file
            $table->text("change_notes")->nullable(); // Optional: Notes about what changed in this version
            
            $table->timestamps(); // Records when this version entry was created

            // Foreign key constraint (added in a separate migration)
            // $table->foreign("document_id")->references("document_id")->on("documents")->onDelete("cascade");

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("document_versions");
    }
};
