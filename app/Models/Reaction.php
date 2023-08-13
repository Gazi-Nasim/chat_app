<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;
    protected $fillable = [
        "post_id",
        "reaction",
    ];

    public function postRe()
    {
        return $this->belongsTo(Post::class, "post_id");
    }
}
