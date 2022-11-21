<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Group extends Model
{
    use HasFactory, Searchable;

    public function user() {
        return $this->hasOne('App\Models\User');
    }

    /**
     * Required fields to create a Group object,
     * creator_id is not here since it can be fetched
     * by the request.
     */
    public const REQUIRED_FIELDS = [
        'name',
        'description'
    ];
}
