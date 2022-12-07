{{-- 
    This is the template used to show the post's page.
    This page will show all the infos about the post such as:
        - Title
        - Group
        - User
        - Full post description / image
        - Comments
--}}

@php
    /** @var $post '\App\Models\Post' */
    $group = $post->group()->first();
    $user = $post->user()->first();
    $comments = $post->comments()->get();
    $list_lambda = function ($p) { 
                 return ['user' => $p->user()->first(), 'content' => $p->content]; 
    };
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>
    
    <br/>
    
    <small> Posted in <a href="{{ route('group.show', $group->name) }}"> {{ $group->name }} </a> by <a href="{{ route('userpage.show', $user->name) }}"> {{ $user->name }} </a> </small>
    
    <br/>

    <p> {{ $post->content }} </p>

    <br/>

    @if($post->image_id)
        <img src='{{ route('image.get', $post->image_id) }}'/>
    @endif

    <h3> COMMENTS({{ $comments->count() }}) </h3>

    <form action="/create-comment" method="post">
        @csrf
        <x-input-label for="content">
            New Comment
        </x-input-label>
        <x-textarea 
            id="content" 
            name="content"
            rows="4"
            maxlength="500"
            class="block mt-1 w-full" 
            placeholder="Insert the comment's content..."
            required/>
        <input type="hidden" name="post_id" value="{{ $post->id}}" />
        <x-primary-button>
            Confirm
        </x-primary-button>

    </form>

    <br/>

    <x-list.list itemtemplate='components.comments.small' :items="$comments->map($list_lambda)" />

</x-app-layout>
