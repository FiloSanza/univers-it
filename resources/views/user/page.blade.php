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
    <header class="mx-auto border-b-2 border-gray-600 p-3 lg:max-w-5xl">
        <div class="flex flex-col items-center lg:flex-row">
            <div class="lg:w-1/5">
                <img src="{{ route('image.get', $user->propic) }}" class="mx-auto w-24 h24 rounded-full" />
            </div>
            <div class="text-center lg:w-3/5">
                <div class="font-bold text-2xl"> {{ $user->name }} </div>
                <div class="font-semibold"> Università di Bologna </div>
            </div>
            <div class="flex flex-col lg:w-1/5">
                <div class="m-auto flex">
                    <div class="text-center m-1">
                        <p> {{ count($posts) }} </p> 
                        <small>Posts</small>
                    </div>
                    <div 
                        class="text-center m-1"
                        onclick="document.getElementsByName('followers-modal')[0].style.display = 'block'"
                    >
                        <p> {{ count($followers) }} </p> 
                        <small>Followers</small>
                    </div>
                    <div 
                        class="text-center m-1"
                        onclick="document.getElementsByName('following-modal')[0].style.display = 'block'"
                    >
                        <p> {{ count($follows) }} </p> 
                        <small>Following</small>
                    </div>
                </div>
                @unless(Auth::id() == $user->id)
                <div class="m-auto h-10 grid place-items-center">
                    <x-follow-button :userid="$user->id" :isfollowed="$already_followed" />
                </div>
                @endunless
            </div>
        </div>
    </header>

    <x-popup name="followers-modal">
        <x-slot:header>
            Followers
        </x-slot:header>
        <x-list.list itemtemplate='components.users.small' :items="$followers->map($user_lambda)" />
    </x-popup>

    <x-popup name="following-modal">
        <x-slot:header>
            Following
        </x-slot:header>
        <x-list.list itemtemplate='components.users.small' :items="$follows->map($user_lambda)" />
    </x-popup>

    <section class="mx-auto mt-5 p-5 lg:w-4/5">
        <div class="w-full text-center text-2xl">
            <h3> POSTS </h3>
        </div>
        <x-list.list itemtemplate='components.posts.small' :items="$posts->map($post_lambda)" />
    </section>

</x-app-layout>
