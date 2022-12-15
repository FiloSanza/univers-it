@php
    /** @var $group '\App\Models\Group' */
    $posts = $group->posts()->get();
    $posts = Helper::sortByMostRecent($posts);
    $already_followed = Auth::user()
        ->followed_groups()
        ->where('group_id', $group->id)
        ->first();
    $list_lambda = function ($p) { 
        return [ 'post' => $p, 'user' => $p->user()->first(), 'group' => $p->group()->first() ]; 
    };
@endphp

<x-app-layout>
    <div class="w-full h-40 overflow-clip">
        <img class="w-full h-auto" src="{{ route('image.get', $group->image_id) }}" />
    </div>

    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $group->name }}
    </h1>

    <p> {{ $group->description }} </p>

    <br>

    <x-follow-button :groupid="$group->id" :isfollowed="$already_followed"/>
    
    <a href="{{ route('post.create', $group->name) }}">
        Post
    </a>
    
    <br>

    <h3> POSTS </h3>
    <x-list.list itemtemplate='components.posts.small' :items="$posts->map($list_lambda)" />

</x-app-layout>
