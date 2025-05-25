<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Theme extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "themes";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "theme_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "theme_name",
        "description",
    ];

    /**
     * The documents that belong to the theme.
     */
    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, "document_themes", "theme_id", "document_id", "theme_id", "document_id")
                    ->withTimestamps(); // If pivot table has timestamps
    }
}

