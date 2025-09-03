<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }
    // App\Models\Post.php
    public function getTotalLikesAttribute()
    {
        return $this->reactions()->where('like', true)->count();
    }

    public function getTotalDislikesAttribute()
    {
        return $this->reactions()->where('dislike', true)->count();
    }

}
