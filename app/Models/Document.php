<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "documents";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "document_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "title",
        "document_number",
        "document_year",
        "description",
        "issuance_date",
        "announcement_date",
        "type_id",
        "status_id",
        "heading_id",
        "has_consolidation",
        "has_translation",
        "thumbnail_url",
        "preview_url",
        "file_path",
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
        "has_consolidation" => "boolean",
        "has_translation" => "boolean",
    ];

    /**
     * Get the type of the document.
     */
    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class, "type_id", "type_id");
    }

    /**
     * Get the status of the document.
     */
    public function documentStatus(): BelongsTo
    {
        return $this->belongsTo(DocumentStatus::class, "status_id", "status_id");
    }

    /**
     * Get the main entry heading (issuing authority) of the document.
     */
    public function mainEntryHeading(): BelongsTo
    {
        return $this->belongsTo(MainEntryHeading::class, "heading_id", "heading_id");
    }

    /**
     * Get the themes associated with the document.
     */
    public function themes(): BelongsToMany
    {
        return $this->belongsToMany(Theme::class, "document_themes", "document_id", "theme_id", "document_id", "theme_id")
                    ->withTimestamps(); // If pivot table has timestamps
    }

    /**
     * Get the labels associated with the document.
     */
    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, "document_labels", "document_id", "label_id", "document_id", "label_id")
                    ->withTimestamps(); // If pivot table has timestamps
    }

    /**
     * Get the versions of the document.
     */
    public function versions(): HasMany
    {
        return $this->hasMany(DocumentVersion::class, "document_id", "document_id");
    }

    /**
     * Get the latest version of the document.
     */
    public function latestVersion()
    {
        // Assuming version_number or created_at determines the latest
        return $this->hasOne(DocumentVersion::class, "document_id", "document_id")->latestOfMany("version_number"); 
        // Or ->latestOfMany("created_at");
    }

    public function scopeSearch($query, $search)
    {
        if (empty($search)) {
            return $query;
        }

        return $query->where(function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('document_number', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhereHas('documentType', function($q) use ($search) {
                    $q->where('type_name', 'like', "%{$search}%");
                })
                ->orWhereHas('mainEntryHeading', function($q) use ($search) {
                    $q->where('heading_name', 'like', "%{$search}%");
                })
                ->orWhereHas('themes', function($q) use ($search) {
                    $q->where('theme_name', 'like', "%{$search}%");
                });
        });
    }

    public function scopeFilter($query, array $filters)
    {
        return $query->when($filters['type_id'] ?? false, function ($query, $type_id) {
            $query->where('type_id', $type_id);
        })
        ->when($filters['status_id'] ?? false, function ($query, $status_id) {
            $query->where('status_id', $status_id);
        })
        ->when($filters['heading_id'] ?? false, function ($query, $heading_id) {
            $query->where('heading_id', $heading_id);
        })
        ->when($filters['theme_id'] ?? false, function ($query, $theme_id) {
            $query->whereHas('themes', function($q) use ($theme_id) {
                $q->where('themes.theme_id', $theme_id);
            });
        })
        ->when($filters['date_from'] ?? false, function ($query, $date) {
            $query->where('announcement_date', '>=', $date);
        })
        ->when($filters['date_to'] ?? false, function ($query, $date) {
            $query->where('announcement_date', '<=', $date);
        })
        ->when($filters['document_year'] ?? false, function ($query, $year) {
            $query->where('document_year', $year);
        });
    }
   
}

