<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Label extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "labels";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "label_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "label_name",
        "description",
    ];

    /**
     * The documents that belong to the label.
     */
    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, "document_labels", "label_id", "document_id", "label_id", "document_id")
                    ->withTimestamps(); // If pivot table has timestamps
    }
}

