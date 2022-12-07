<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Group extends Model
{
    use HasFactory, Searchable;

    /**
     * Returns the user that created the post.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns all the posts in the group.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts() {
        return $this->hasMany(Post::class);
    }

    /**
     * All the validation rule that the HTTP request needs to pass.
     * 
     * @var array<string,string>
     */
    public const VALIDATION_RULES = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        // TODO: 'image' => 'required|image|size:2048|mimes:jpeg,jpg,png,gif'           // Max 2Mb
    ];
}
