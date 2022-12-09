<?php

namespace App\Http\Controllers;

use \App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\Groups;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
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

        return view('dashboard', ['feed' => $sorted_feed]);
    }
}
