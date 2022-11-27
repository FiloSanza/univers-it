<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Return the groups created by the user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups() {
        return $this->hasMany(Group::class);
    }

    /**
     * Return the posts created by the user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts() {
        return $this->hasMany(Post::class);
    }

    /**
     * Return all the users that this user follows.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers() {
        return $this->belongsToMany(
            User::class,        // Initial models we start from.
            FollowEdge::class,  // Pivot model that connects the user models.
            'followed_id',      // Foreign key for this user in the pivot table.
            'follower_id'       // Foreign key pointing to the follower user model.
        );
    }

    /**
     * Return all the users followed by this user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows() {
        return $this->belongsToMany(
            User::class,        // Initial models we start from.
            FollowEdge::class,  // Pivot model that connects the user models.
            'follower_id',      // Foreign key for this user in the pivot table.
            'followed_id'       // Foreign key pointing to the followed user model.
        );
    }
}
