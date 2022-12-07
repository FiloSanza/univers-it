@php
    /** @var $group '\App\Models\Group' */
    $posts = $group->posts()->get();
    $list_lambda = function ($p) { 
        return [ 'post' => $p, 'user' => $p->user()->first() ]; 
    };
@endphp

<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $group->name }}
    </h2>

    <img src="{{ route('image.get', $group->image_id) }}" />

    <p> {{ $group->description }} </p>

    <br>
    
    <a href="{{ route('post.create', $group->name) }}">
        Post
    </a>
    
    <br>

    <h3> POSTS </h3>
    <x-list.list itemtemplate='components.posts.small' :items="$posts->map($list_lambda)" />

</x-app-layout>
