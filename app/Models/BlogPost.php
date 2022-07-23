<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\DeletedAdminScope;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Traits\Taggable;

class BlogPost extends Model
{
    // protected $table = 'blogposts';
    use HasFactory, SoftDeletes, Taggable;


    protected $fillable = ['title', 'content', 'user_id'];


    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->latest();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable')->withTimestamps();
    }

    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query)
    {
        // comments_count
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public function scopeLatestWithRelations(Builder $query)
    {
        return $query->latest()
            ->withCount('comments')
            ->with('user')
            ->with('tags');
    }

    public static function boot()
    {
        static::addGlobalScope(new DeletedAdminScope);
        parent::boot();

      //  NB uncomment below if you have not already moved these to the Observer (BlogPostObserver.php)
//        static::deleting(function (BlogPost $blogPost) {
//            $blogPost->comments()->delete();
//            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
//        });
//
//        static::updating(function (BlogPost $blogPost) {
//            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
//        });
//
//        static::restoring(function (BlogPost $blogPost) {
//            $blogPost->comments()->restore();
//        });
    }
}
