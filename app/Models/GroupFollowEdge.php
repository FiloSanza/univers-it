<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class GroupFollowEdge extends Model
{
    use HasFactory, Searchable;

    /**
     * Returns the user that follows the group.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function follower() {
        return $this->hasOne(User::class);
    }

    /**
     * Returns the group.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function followed() {
        return $this->hasOne(Group::class);
    }

    /**
     * All the validation rule that the HTTP request needs to pass.
     * 
     * @var array<string,string>
     */
    public const VALIDATION_RULES = [
        'group_id' => 'required|int|exists:groups,id'
    ];
}
