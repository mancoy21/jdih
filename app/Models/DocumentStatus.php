<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentStatus extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "document_statuses";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "status_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "status_name",
        "description",
    ];

    /**
     * Get the documents associated with the status.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, "status_id", "status_id");
    }

    /**
     * Get the document versions associated with the status.
     */
    public function documentVersions(): HasMany
    {
        // Assuming versions also link directly to status for historical accuracy
        return $this->hasMany(DocumentVersion::class, "status_id", "status_id");
    }
}

