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

}
