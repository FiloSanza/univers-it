<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Reaction extends Model
{
    use HasFactory, Searchable;

    /**
     * All the validation rule that the HTTP request needs to pass.   
     * 
     * @var array<string,string>
     */
    public const VALIDATION_RULES = [
        'name' => 'required|string|max:50',
    ];
}
