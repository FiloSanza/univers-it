<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function post() {
        return $this->hasOne('App\Models\Post');
    }

    public function user() {
        return $this->hasOne('App\Models\User');
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
