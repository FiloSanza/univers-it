<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ReactionImage extends Model
{
    use HasFactory, Searchable;

    /**
     * Returns the image related to the reaction.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image() {
        $this->belongsTo(Image::class);
    }

    /**
     * All the validation rule that the HTTP request needs to pass.   
     * 
     * @var array<string,string>
     */
    public const VALIDATION_RULES = [
        'name' => 'required|string|max:50',
        // TODO: 'image' => 'required|image|size:2048|mimes:jpeg,jpg,png,gif'           // Max 2Mb
    ];
}
