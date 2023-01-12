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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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

        return view('home.home', ['feed' => $feed]);
    }
}
