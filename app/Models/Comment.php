<?php

namespace App\Models;

use App\Models\Posts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function users()
    {
        return $this->belongsTo(User::class, "c_user_id");
    }

    public function post()
    {
        return $this->belongsTo(Post::class, "c_post");
    }
}
