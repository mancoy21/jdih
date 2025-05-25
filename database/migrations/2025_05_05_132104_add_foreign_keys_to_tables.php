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
        Schema::table("documents", function (Blueprint $table) {
            $table->foreign("type_id")
                  ->references("type_id")
                  ->on("document_types")
                  ->onDelete("restrict"); // Prevent deleting type if documents use it

            $table->foreign("status_id")
                  ->references("status_id")
                  ->on("document_statuses")
                  ->onDelete("restrict"); // Prevent deleting status if documents use it

            $table->foreign("heading_id")
                  ->references("heading_id")
                  ->on("main_entry_headings")
                  ->onDelete("set null"); // Allow deleting heading, set FK to null
        });

        Schema::table("document_versions", function (Blueprint $table) {
            $table->foreign("document_id")
                  ->references("document_id")
                  ->on("documents")
                  ->onDelete("cascade"); // Delete versions if parent document is deleted

            // Assuming versions also reference the master tables directly for historical accuracy
            $table->foreign("type_id")
                  ->references("type_id")
                  ->on("document_types")
                  ->onDelete("restrict");

            $table->foreign("status_id")
                  ->references("status_id")
                  ->on("document_statuses")
                  ->onDelete("restrict");

            $table->foreign("heading_id")
                  ->references("heading_id")
                  ->on("main_entry_headings")
                  ->onDelete("set null");
        });

        Schema::table("document_themes", function (Blueprint $table) {
            $table->foreign("document_id")
                  ->references("document_id")
                  ->on("documents")
                  ->onDelete("cascade");

            $table->foreign("theme_id")
                  ->references("theme_id")
                  ->on("themes")
                  ->onDelete("cascade");
        });

        Schema::table("document_labels", function (Blueprint $table) {
            $table->foreign("document_id")
                  ->references("document_id")
                  ->on("documents")
                  ->onDelete("cascade");

            $table->foreign("label_id")
                  ->references("label_id")
                  ->on("labels")
                  ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("documents", function (Blueprint $table) {
            $table->dropForeign(["type_id"]);
            $table->dropForeign(["status_id"]);
            $table->dropForeign(["heading_id"]);
        });

        Schema::table("document_versions", function (Blueprint $table) {
            $table->dropForeign(["document_id"]);
            $table->dropForeign(["type_id"]);
            $table->dropForeign(["status_id"]);
            $table->dropForeign(["heading_id"]);
        });

        Schema::table("document_themes", function (Blueprint $table) {
            $table->dropForeign(["document_id"]);
            $table->dropForeign(["theme_id"]);
        });

        Schema::table("document_labels", function (Blueprint $table) {
            $table->dropForeign(["document_id"]);
            $table->dropForeign(["label_id"]);
        });
    }
};
