<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable;

    public function group() {
        return $this->hasOne('App\Models\Group');
    }

    public function user() {
        return $this->hasOne('App\Models\User');
    }

}
