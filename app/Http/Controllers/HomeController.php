<?php

namespace App\Http\Controllers;

use \App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class HomeController extends Controller
{
    /**
     * Return the user's feed.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        if (!Auth::check()) {
            $feed = Post::inRandomOrder()->limit(20)->get();
        } else {
            $user = Auth::user();
            $follows = $user->follows()->get();
            $groups = $user->followed_groups()->get();
            
            $feed = new Collection();

            foreach ($groups as $group) {
                $posts = $group->posts()->get();
                foreach ($posts as $post) {
                    $feed->add($post);
                }
            }

            foreach ($follows as $follow) {
                $posts = $follow->posts()->get();
                foreach ($posts as $post) {
                    $feed->add($post);
                }
            }
            $feed->unique();
        }

        $sorted_feed = $feed->sortByDesc(function($post)
        {
            return strtotime($post->created_at);
        });

        return view('home.home', ['feed' => $sorted_feed]);
    }
}
