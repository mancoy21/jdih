<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentType extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "document_types";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "type_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "type_name",
        "description",
    ];

    /**
     * Get the documents associated with the type.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, "type_id");
    }

    /**
     * Get the document versions associated with the type.
     */
    public function documentVersions(): HasMany
    {
        // Assuming versions also link directly to type for historical accuracy
        return $this->hasMany(DocumentVersion::class, "type_id", "type_id");
    }
}

