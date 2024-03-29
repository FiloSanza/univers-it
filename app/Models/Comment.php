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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post() {
        return $this->belongsTo(Post::class);
    }

    /**
     * Return the user that posted the comment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Return the parent comment if present.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentComment() {
        return $this->belongsTo(Comment::class);
    }

    /**
     * All the validation rule that the HTTP request needs to pass.
     * 
     * @var array<string,string>
     */
    public const VALIDATION_RULES = [
        'content' => 'required|string',
        'post_id' => 'required|int|exists:posts,id',
        'reply_to' => 'nullable|int|exists:comments,id'
    ];
}
