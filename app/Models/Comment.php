<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Return the post this comment belongs to.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post() {
        return $this->hasOne(Post::class);
    }

    /**
     * Return the user that posted the comment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->hasOne(User::class);
    }

}
