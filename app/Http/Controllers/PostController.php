<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    /**
     * Show the form for creating a new post.
     *
     * @param string $name of the group
     * @return \Illuminate\View\View
     */
    public function create(string $name)
    {
        Validator::validate(['name' => $name], [
            'name' => Group::VALIDATION_RULES['name'].'|exists:groups'
        ]);
        $group = Group::where('name', $name)->first();
        return view('posts.create-post', ['group' => $group]);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate(Post::VALIDATION_RULES);
        
        $post = new Post();
        $user_id = Auth::id();
        $post->user_id = $user_id;
        
        foreach (Post::VALIDATION_RULES as $field => $_) {
            $post->$field = $request->$field;
        }

        $post->save();

        return redirect()->route('post.show', ['id' => $post->id]);
    }

    /**
     * Display the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        Validator::validate(['id' => $id], [
            'id' => 'required|int|exists:posts'
        ]);

        $post = Post::where('id', $id)->first();
        return view('posts.post', ['post' => $post]);
    }

}
