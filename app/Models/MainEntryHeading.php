<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MainEntryHeading extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "main_entry_headings";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "heading_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "heading_name",
        "description",
    ];

    /**
     * Get the documents associated with the heading.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, "heading_id", "heading_id");
    }

    /**
     * Get the document versions associated with the heading.
     */
    public function documentVersions(): HasMany
    {
        // Assuming versions also link directly to heading for historical accuracy
        return $this->hasMany(DocumentVersion::class, "heading_id", "heading_id");
    }
}

