<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentVersion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "document_versions";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "version_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "document_id",
        "version_number",
        "title",
        "document_number",
        "document_year",
        "description",
        "issuance_date",
        "announcement_date",
        "type_id",
        "status_id",
        "heading_id",
        "file_path",
        "change_notes",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "issuance_date" => "date",
        "announcement_date" => "date",
        "document_year" => "integer",
        "version_number" => "integer",
    ];

    /**
     * Get the parent document that this version belongs to.
     */
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class, "document_id", "document_id");
    }

    /**
     * Get the type associated with this document version.
     */
    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class, "type_id", "type_id");
    }

    /**
     * Get the status associated with this document version.
     */
    public function documentStatus(): BelongsTo
    {
        return $this->belongsTo(DocumentStatus::class, "status_id", "status_id");
    }

    /**
     * Get the main entry heading associated with this document version.
     */
    public function mainEntryHeading(): BelongsTo
    {
        return $this->belongsTo(MainEntryHeading::class, "heading_id", "heading_id");
    }
}

