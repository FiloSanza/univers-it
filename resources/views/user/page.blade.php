@php
    /** @var $user '\App\Models\User' */
    $already_followed = Helper::isAFollowerOfB(Auth::user(), $user);
    $followers = $user->followers()->get();
    $follows = $user->follows()->get();
    $posts = $user->posts()->get();
    $posts = Helper::sortByMostRecent($posts);
    $user_lambda = function ($f) { return [ 'user' => $f, 'already_followed' => Helper::isAFollowerOfB(Auth::user(), $f) ]; };
    $post_lambda = function ($p) { 
        return [ 'post' => $p, 'group' => $p->group()->first(), 'user' => $p->user()->first() ]; 
    };
@endphp

<x-app-layout>

    <x-slot name="script">
        @vite([
            'resources/js/popup.js',
            'resources/js/userpage.js'
        ])
    </x-slot>

    <header class="mx-auto border-b-2 border-gray-600 p-3 lg:max-w-5xl">
        <div class="flex flex-col items-center lg:flex-row">
            <div class="lg:w-1/5">
                <img src="{{ route('image.get', $user->propic) }}" class="mx-auto w-24 h-24 rounded-full" alt="{{$user->name}} profile picture." />
            </div>
            <div class="text-center lg:w-3/5">
                <div id="username" class="font-bold text-2xl">{{$user->name}}</div>
                <div class="font-semibold"> Università di Bologna </div>
            </div>
            <div class="flex flex-col lg:w-1/5">
                <div class="m-auto flex">
                    <div class="text-center m-1 p-1">
                        <p> {{ count($posts) }} </p> 
                        <small>Posts</small>
                    </div>
                    <div class="text-center m-1 p-1 cursor-pointer hover:bg-gray-100 hover:rounded-xl" data-target='followers-modal'>
                        <p id='followers-count'> {{ count($followers) }} </p> 
                        <small>Followers</small>
                    </div>
                    <div class="text-center m-1 p-1 cursor-pointer hover:bg-gray-100 hover:rounded-xl" data-target='following-modal'>
                        <p id='following-count'> {{ count($follows) }} </p> 
                        <small>Following</small>
                    </div>
                </div>
                @if(Auth::user() !== null && Auth::user()->hasVerifiedEmail() && Auth::id() !== $user->id)
                    <div class="m-auto h-10 grid place-items-center">
                        <x-follow-button :userid="$user->id" :isfollowed="$already_followed" :ismainbutton="true" />
                    </div>
                @endunless
            </div>
        </div>
    </header>

    <x-popup name="followers-modal">
        <x-slot:header>
            Followers
        </x-slot:header>
        <div id="followers-list">
        </div>
    </x-popup>

    <x-popup name="following-modal">
        <x-slot:header>
            Following
        </x-slot:header>
        <div id="following-list">
        </div>
    </x-popup>

    <section class="mx-auto mt-5 p-5 lg:w-4/5">
        <div class="w-full text-center text-2xl">
            <h3> POSTS </h3>
        </div>
        <x-list.list itemtemplate='components.posts.small' :items="$posts->map($post_lambda)" />
    </section>

</x-app-layout>