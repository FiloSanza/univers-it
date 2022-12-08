<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class PostReaction extends Model
{
    use Searchable;

    /**
     * Returns the reaction.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reaction() {
        return $this->belongsTo(ReactionImage::class);
    }

    /**
     * Returns the user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the post.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post() {
        return $this->belongsTo(Post::class);
    }

    public const VALIDATION_RULES = [
        'reaction_image_id' => 'required|int|exists:reaction_images,id',
        'post_id' => 'required|int|exists:posts,id',
    ];
}
