<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'editor_id'];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function editor()
    {
        return $this->belongsTo(Editor::class, 'editor_id');
    }
}
