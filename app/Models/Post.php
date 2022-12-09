<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded= [];
    public function postComments()
    {
        return $this->hasMany(PostComment::class);
    }
    public function lastPostComment()
    {
        return $this->hasOne(PostComment::class)->latest();
    }
}
