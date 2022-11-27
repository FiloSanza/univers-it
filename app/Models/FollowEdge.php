<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class FollowEdge extends Model
{
    use HasFactory, Searchable;

    /**
     * Table associated with the model in the database.
     * 
     * @var string table name.
     */
    protected $table = 'follow_edges';

    /**
     * Returns the user that follows.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function follower() {
        return $this->hasOne(User::class);
    }

    /**
     * Returns the followed user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function followed() {
        return $this->hasOne(User::class);
    }

    /**
     * All the validation rule that the HTTP request needs to pass.
     * 
     * @var array<string,string>
     */
    public const VALIDATION_RULES = [
        'followed_id' => 'required|int|exists:users,id'
    ];
}
