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
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot> --}}
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-flow-col">
            <div class="bg-blue-700"></div> {{-- Img --}}
            <div class="bg-red-400 col-span-3">
                <p class="font-bold text-2xl"> {{ $user->name }} </p>
                <p class="font-semibold"> Università di Bologna </p>
            </div>
            <div class="bg-green-300 text-right grid grid-rows-2">
                <div>
                    <p> {{count($posts)}} <small>Posts</small>  </p>
                    <p> {{count($followers)}} <small>Followers</small> </p>
                    <p> {{count($follows)}} <small>Following</small> </p>
                </div>
                <div>
                    @unless(Auth::id() == $user->id)
                        <x-users.follow-button :userid="$user->id" :isfollowed="$already_followed" />
                    @endunless
                </div>
            </div>
        </div>
    </div>

    {{-- @unless(Auth::id() == $user->id)
        <x-users.follow-button :userid="$user->id" :isfollowed="$already_followed" />
    @endunless
    
    <p> Followers: {{ count($followers) }} </p>
    <p> Follows: {{ count($follows) }} </p>
    
    <br>
    <h3 class="bg-blue-300"> Followers </h3>
    <x-list.list itemtemplate='components.users.small' :items="$followers->map($user_lambda)" />
    
    <br>
    <h3> Follows </h3>
    <x-list.list itemtemplate='components.users.small' :items="$follows->map($user_lambda)" />
        
    <br>
    <h3> POSTS </h3>
    <x-list.list itemtemplate='components.posts.small' :items="$posts->map($post_lambda)" /> --}}



</x-app-layout>
