<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use App\Models\User;

class MailSettings extends Model
{
    use HasFactory, Searchable;
    
    /**
     * Timestampes aren't needed.
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * Returns the user to whom the settings belong.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }


    /**
     * All the validation rule that the HTTP request needs to pass.   
     * 
     * @var array<string,string>
     */
    public const VALIDATION_RULES = [
        'new_post' => 'required|boolean',
        'new_follower' => 'required|boolean',
        'new_comment' => 'required|boolean',
        'new_reaction' => 'required|boolean',
    ];
}
