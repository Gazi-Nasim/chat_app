<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        "picture",
        "caption"
    ];

    public function comnts()
    {
        return $this->hasMany(Comment::class, 'post_id')->orderByDesc('id');
    }


    public function reacts()
    {
        return $this->hasMany(Reaction::class, 'post_id');
    }
}
