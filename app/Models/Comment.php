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

    /**
     * All the validation rule that the HTTP request needs to pass.
     * 
     * @var array<string,string>
     */
    public const VALIDATION_RULES = [
        'content' => 'required|string|max:255',
        'post_id' => 'required|int|exists:comments,id'
    ];
}
