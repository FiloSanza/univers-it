<?php

namespace App\Http\Controllers;

use App\Models\PostReaction;
use Illuminate\Http\Request;

class PostReactionController extends Controller
{
    /**
     * Stores a new PostReaction.
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(PostReaction::VALIDATION_RULES);

        $post_reaction = new PostReaction();

        $post_reaction->user_id = Auth::id();
        $post_reaction->post_id = $request->post_id;
        $post_reaction->reaction_id = PostReaction::where('name', $request->reaction_name)->first()->id;

        $post_reaction->save();

        return Response('Success.', 200);
    }

    public function getInfo(int $id)
    {
        $like_reaction = Reactions::where('name', 'like')->first();
        $dislike_reaction = Reactions::where('name', 'dislike')->first();

        $likes = PostReaction::where([ 'post_id' => $id, 'reaction_id' => $like_reaction->id ])->get()->count();
        $dislikes = PostReaction::where([ 'post_id' => $id, 'reaction_id' => $dislike_reaction->id ])->get()->count();

        if (Auth::check()) {
            $user_reaction = PostReaction::where([ 'post_id' => $id, 'user_id' => Auth::id() ])->first();
            $user_reaction_string = $user_reaction ? $user_reaction->name : null;

            return response()->json([
                'likes' => $likes,
                'dislikes' => $dislikes,
                'user_reaction' => $user_reaction_string
            ]);
        }

        return response()->json([
            'likes' => $likes,
            'dislikes' => $dislikes
        ]);
    }
}
