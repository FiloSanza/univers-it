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
    public function __invoke(Request $request)
    {
        $request->validate(PostReaction::VALIDATION_RULES);

        $post_reaction = new PostReaction();

        $post_reaction->user_id = Auth::id();
        foreach (PostReaction::VALIDATION_RULES as $field) {
            $post_reaction->$field = $request->$field;
        }

        $post_reaction->save();

        return Response('Success.', 200);
    }
}
