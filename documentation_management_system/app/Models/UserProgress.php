<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class UserProgress extends Model
{
    protected $fillable = ['user_id', 'article_id', 'progress_seconds'];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
