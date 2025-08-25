<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'category_id',
        'editor_id',
        'status',
        'featured',
        'views',
        'image_path',
        'image_alt'
    ];

    protected $dates = ['published_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function editor()
    {
        return $this->belongsTo(Editor::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }
    public function likes()
    {
        return $this->hasMany(ArticleLike::class);
    }
}
