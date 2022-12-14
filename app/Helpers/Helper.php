<?php

namespace App\Helpers;
use App\Models\User;

class Helper
{
    public static function sortByMostRecent($collection)
    {
        return $collection->sortByDesc(function($post)
        {
            return strtotime($post->created_at);
        });
    }

    /**
     * Returns whether user_a follows user_b or not.
     *  
     * @param User $user_a
     * @param User $user_b
     * @return boolean
     */
    public static function isAFollowerOfB(User $user_a, User $user_b) {
        return $user_b->followers()->where(['users.id' => $user_a->id])->first() !== null;
    }
}