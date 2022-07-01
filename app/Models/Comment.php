<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['user_id', 'content'];

    // blog_post_id
//    public function blogPost()
//    {
//        // return $this->belongsTo('App\BlogPost', 'post_id', 'blog_post_id');
//        return $this->belongsTo('App\Models\BlogPost');
//    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function (Comment $comment) {

            if ($comment->commentable_type === BlogPost::class) {
                Cache::tags(['blog-post'])->forget("blog-post-{$comment->commentable_id}");
                Cache::tags(['blog-post'])->forget('mostCommented');
            }
        });

        // static::addGlobalScope(new LatestScope);
    }
}
