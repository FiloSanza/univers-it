<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
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

        return response()->json(['success' => 'success'], 200);
    }

        
    /**
     * Get all the comments linked to a post.
     *
     * @param  string $postid: the id of the post;
     * @return mixed: html containing all the comments and the comments count.
     */
    public function get(string $postid) {
        $post = Post::where('id', $postid)->first();
        $list_lambda = function ($p) { 
            return ['user' => $p->user()->first(), 'content' => $p->content]; 
        };
        $comments = $post->comments()->get();
        return json_encode([
            'view' => view('components.list.list', 
                [ 'itemtemplate' => 'components.comments.small', 
                'items' => $comments->map($list_lambda) ])->render(),
            'count' => $comments->count()
        ]);
    }
}
