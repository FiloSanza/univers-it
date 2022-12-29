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

<x-app-layout id='post-page'>

    <x-slot name="script">
        @vite([
            'resources/js/popup.js',
            'resources/js/comments.js', 
            'resources/js/like.js', 
        ])
    </x-slot>

    <div class="border-b-2 border-gray-600 mt-4 p-4">
        <div class="flex flex-row text-gray-800">
            <img src="{{ route('image.get', $group->image_id) }}" class="mx-2 w-7 h-7 rounded-full" alt="Group Image" />
            <p class="text-sm my-auto"> Posted in <a href="{{ route('group.show', $group->name) }}" class="underline">{{ $group->name }}</a> by <a href="{{ route('userpage.show', $user->name) }}" class="underline"> {{ $user->name }} </a> </p>
        </div>
        <header class="w-full flex flex-col lg:flex-row my-2 py-2 border-b-[1px]">
            <h1 class="mx-auto font-bold text-xl text-gray-800 leading-tight">
                {{ $post->title }}
            </h1>
        </header>
        
        <p> {{ $post->content }} </p>
    
        @if($post->image_id)
            <div class="mx-auto w-4/5 mt-3">
                <img class="max-w-full h-auto rounded-xl" src='{{ route('image.get', $post->image_id) }}' alt="Post Image" />
            </div>
        @endif

        <div class="flex flex-row">
            <div id="like-button" class="w-1/2 m-1 mx-2 p-2 cursor-pointer bg-blue-100 inline-block rounded-xl align-right lg:mx-0 hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                </svg>
                <span id="like-number"></span>
            </div>
            <div id="dislike-button" class="w-1/2 m-1 mx-2 p-2 cursor-pointer bg-blue-100 inline-block rounded-xl align-right lg:mx-0 hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 15h2.25m8.024-9.75c.011.05.028.1.052.148.591 1.2.924 2.55.924 3.977a8.96 8.96 0 01-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398C20.613 14.547 19.833 15 19 15h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 00.303-.54m.023-8.25H16.48a4.5 4.5 0 01-1.423-.23l-3.114-1.04a4.5 4.5 0 00-1.423-.23H6.504c-.618 0-1.217.247-1.605.729A11.95 11.95 0 002.25 12c0 .434.023.863.068 1.285C2.427 14.306 3.346 15 4.372 15h3.126c.618 0 .991.724.725 1.282A7.471 7.471 0 007.5 19.5a2.25 2.25 0 002.25 2.25.75.75 0 00.75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 002.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384" />
                </svg>  
                <span id="dislike-number"></span>
            </div>
        </div>
    </div>

    <div class="flex flex-row justify-between font-bold">        
        <h2 class="my-3 mx-2 lg:mx-0"> COMMENTS(<span id="comments-count"></span>) </h2>
        @auth
        <div class="m-1 mx-2 p-2 cursor-pointer bg-blue-100 inline-block rounded-xl align-right lg:mx-0 hover:bg-gray-100" data-target='comment-modal'>
            <span>New Comment</span>
        </div>
        @endauth
    </div>

    <div id="comments-list" data-post="{{ $post->id }}"></div>

    <x-popup name="comment-modal">
        <x-slot:header>
            New Comment
        </x-slot:header>
        <form id="comment-form">
            @csrf
            <x-input-label class="hidden" for="content">
                New Comment
            </x-input-label>
            <x-textarea 
                id="content" 
                name="content"
                rows="4"
                class="block mt-1 w-full" 
                placeholder="Insert the comment's content..."
                required/>
            <input id="post_id" type="hidden" name="post_id" value="{{ $post->id}}" />
            <x-primary-button class="my-2" id="submit-comment">
                Confirm
            </x-primary-button>
        </form>
    </x-popup>

</x-app-layout>
