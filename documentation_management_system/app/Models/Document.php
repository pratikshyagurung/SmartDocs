<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // Table is "documents" by convention — no need to set $table

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'title',
        'type',
        'content',
        'status',
        'editor_id',
        'category_id',
    ];

    /**
     * Simple casts (optional)
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationships
     */
    public function editor()
    {
        return $this->belongsTo(Editor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scopes
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
