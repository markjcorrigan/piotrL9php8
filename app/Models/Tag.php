<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogPost;

class Tag extends Model
{
    use HasFactory;

    public function blogPosts()
    {
        return $this->belongsToMany(BlogPost::class)->withTimestamps()->as('tagged');
    }
}
