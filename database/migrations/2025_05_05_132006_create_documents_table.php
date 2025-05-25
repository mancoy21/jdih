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
        Schema::create("documents", function (Blueprint $table) {
            $table->id("document_id"); // Match previous schema name
            $table->string("title")->fulltext();
            $table->string("document_number")->nullable()->index();
            $table->integer("document_year")->nullable()->index();
            $table->text("description")->fulltext();
            $table->date("issuance_date")->nullable()->index();
            $table->date("announcement_date")->nullable()->index();

            // Foreign keys (constraints added in a separate migration for better management)
            $table->unsignedBigInteger("type_id")->index();
            $table->unsignedBigInteger("status_id")->index();
            $table->unsignedBigInteger("heading_id")->nullable()->index(); // Instansi Pembuat

            $table->boolean("has_consolidation")->default(false);
            $table->boolean("has_translation")->default(false);
            $table->string("thumbnail_url")->nullable();
            $table->string("preview_url")->nullable();
            $table->string("file_path")->nullable(); // Path to the original document file (PDF)

            $table->timestamps();
            $table->softDeletes(); // For potential document archival/superseding

            // Add fulltext index for search optimization
            $table->fullText(['title', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("documents");
    }
};
