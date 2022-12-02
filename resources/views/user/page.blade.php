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
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-flow-col">
            <div class="bg-yellow-300">
                <img src="{{ route('image.get', $user->propic) }}" />
            </div>
            <div class="col-span-3 flex items-center justify-center">
                <div class="flex-none">
                    <div class="font-bold text-2xl"> {{ $user->name }} </div>
                    <div class="font-semibold"> Università di Bologna </div>
                </div>
            </div>
            <div class=" text-right grid grid-rows-2">
                <div class="m-auto flex items-center justify-center">
                    <div class="text-center float-left m-1">
                        <p> {{ count($posts) }} </p> 
                        <small>Posts</small>
                    </div>
                    <div class="text-center float-left m-1">
                        <p> {{ count($followers) }} </p> 
                        <small>Followers</small>
                    </div>
                    <div class="text-center float-left m-1">
                        <p> {{ count($follows) }} </p> 
                        <small>Following</small>
                    </div>
                </div>
                <div class="text-center flex items-center justify-center">
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
    <h3 class=""> Followers </h3>
    <x-list.list itemtemplate='components.users.small' :items="$followers->map($user_lambda)" />
    
    <br>
    <h3> Follows </h3>
    <x-list.list itemtemplate='components.users.small' :items="$follows->map($user_lambda)" />
        
    <br>
    <h3> POSTS </h3>
    <x-list.list itemtemplate='components.posts.small' :items="$posts->map($post_lambda)" /> --}}



</x-app-layout>
