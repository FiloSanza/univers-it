<?php

namespace App\Http\Controllers;

use App\Events\NewReactionEvent;
use App\Models\Post;
use App\Models\PostReaction;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // dd($request);
        $request->validate(PostReaction::VALIDATION_RULES);
        $reaction_id = Reaction::where('name', $request->reaction_name)->first()->id;

        // Find previous reactions if any.
        $old = PostReaction::where(['user_id' => Auth::id(), 'post_id' => $request->post_id])->first();
        // Remember is user is setting or removing the reaction based on the previous one if present.
        $was_set = isset($old) && $old->reaction_id == $reaction_id;

        // Remove old reaction.
        if (isset($old)) {
            $old->delete();
        }

        if ($was_set) {
            return Response('Success.', 200);
        }

        $post_reaction = new PostReaction();
        $post_reaction->user_id = Auth::id();
        $post_reaction->post_id = $request->post_id;
        $post_reaction->reaction_id = $reaction_id;

        $post_reaction->save();

        event(new NewReactionEvent($post_reaction));
        return Response('Success.', 200);
    }

    public function getInfo(int $id)
    {
        $like_reaction = Reaction::where('name', 'like')->first();
        $dislike_reaction = Reaction::where('name', 'dislike')->first();

        $likes = PostReaction::where([ 'post_id' => $id, 'reaction_id' => $like_reaction->id ])->get()->count();
        $dislikes = PostReaction::where([ 'post_id' => $id, 'reaction_id' => $dislike_reaction->id ])->get()->count();

        if (Auth::check()) {
            $user_reaction = PostReaction::where([ 'post_id' => $id, 'user_id' => Auth::id() ])->first();

            $user_reaction_string = isset($user_reaction) ? Reaction::where('id', $user_reaction->reaction_id)->first()->name : null;

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