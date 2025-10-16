<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'content', 'user_id',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post_comments()
    {
        return $this->hasMany(PostComments::class,  'post_id', 'id');
    }
}
