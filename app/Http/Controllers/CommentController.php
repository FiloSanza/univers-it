<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Comment::VALIDATION_RULES);
        $comment = new Comment();
        $comment->user_id = Auth::id();

        foreach (Comment::VALIDATION_RULES as $field => $_) {
            $comment->$field = $request->$field;
        }

        $comment->save();


        return redirect()->route('posts.show', $request->post_id);
    }
}
