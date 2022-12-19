<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable;

    /**
     * Return the group the post belongs to.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group() {
        return $this->belongsTo(Group::class);
    }

    /**
     * Returns the user that created the post.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the comments under this post.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    /**
     * All the validation rule that the HTTP request needs to pass.   
     * 
     * @var array<string,string>
     */
    public const VALIDATION_RULES = [
        'title' => 'required|string|max:255',
        'content' => 'required|text',
        'group_id' => 'required|int|exists:groups,id',
        // TODO: 'image' => 'required|image|size:2048|mimes:jpeg,jpg,png,gif'           // Max 2Mb
    ];

}
