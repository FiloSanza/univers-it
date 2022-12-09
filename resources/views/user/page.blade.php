@php
    /** @var $user '\App\Models\User' */
    $already_followed = $user->followers()->where(['users.id' => Auth::id()])->first();
    $followers = $user->followers()->get();
    $follows = $user->follows()->get();
    $posts = $user->posts()->get();
    
    $user_lambda = function ($f) { return [ 'user' => $f ]; };
    $post_lambda = function ($p) { 
        return [ 'post' => $p, 'group' => $p->group()->first() ]; 
    };
@endphp

<x-app-layout>
    <div class="mx-auto lg:max-w-5xl">
        <div class="flex flex-col items-center lg:flex-row">
            <div class="lg:w-1/5">
                <img src="{{ route('image.get', $user->propic) }}" class="mx-auto w-24 h24" />
            </div>
            <div class="text-center lg:w-3/5">
                <div class="font-bold text-2xl"> {{ $user->name }} </div>
                <div class="font-semibold"> Università di Bologna </div>
            </div>
            <div class="flex flex-col lg:w-1/5 lg:justify-end">
                <div class="m-auto flex">
                    <div class="text-center float-left m-1">
                        <p> {{ count($posts) }} </p> 
                        <small>Posts</small>
                    </div>
                    <div 
                        class="text-center float-left m-1"
                        onclick="document.getElementsByName('followers-modal')[0].style.display = 'block'"
                    >
                        <p> {{ count($followers) }} </p> 
                        <small>Followers</small>
                    </div>
                    <div 
                        class="text-center float-left m-1"
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
    </div>

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
        
    {{-- <br>
    <h3> POSTS </h3>
    <x-list.list itemtemplate='components.posts.small' :items="$posts->map($post_lambda)" /> --}}



</x-app-layout>
