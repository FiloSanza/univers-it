<?php

namespace App\Helpers;

class Helper
{
    public static function sortByMostRecent($collection)
    {
        return $collection->sortByDesc(function($post)
        {
            return strtotime($post->created_at);
        });
    }
}