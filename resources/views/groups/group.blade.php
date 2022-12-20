@php
    /** @var $group '\App\Models\Group' */
    $posts = $group->posts()->get();
    $posts = Helper::sortByMostRecent($posts);
    $already_followed = Auth::user() !== null 
        ? Auth::user()
            ->followed_groups()
            ->where('group_id', $group->id)
            ->first()
        : false;
    $list_lambda = function ($p) { 
        return [ 'post' => $p, 'user' => $p->user()->first(), 'group' => $p->group()->first() ]; 
    };
@endphp

<x-app-layout>
    <div class="flex flex-col items-center lg:flex-row border-b-2 border-gray-600 p-3">
        <div class="lg:w-1/5">
            <img class="mx-auto w-24 h-24 rounded-full" src="{{ route('image.get', $group->image_id) }}" alt="{{ $group->name }} profile picture." />
        </div>
        <div class="text-center lg:w-3/5">
            <h1 class="font-bold text-2xl">
                {{ $group->name }}
            </h1>
            <p> {{ $group->description }} </p>
        </div>
        <div class="my-2 w-4/5 flex items-center flex-row lg:flex-col lg:w-1/5">
            @auth
                <div class="w-1/2 text-center lg:w-full lg:my-2">
                    <x-follow-button :groupid="$group->id" :isfollowed="$already_followed"/>
                </div>
                <div class="w-1/2 text-center lg:w-full lg:my-2">
                    <a class="bg-blue-500 text-white rounded-xl px-12 py-0.5 hover:bg-white hover:text-blue-500 hover:border-2 hover:border-blue-500" href="{{ route('post.create', $group->name) }}">
                        Post
                    </a>
                </div>
            @endauth
        </div>
    </div>
    <section class="mx-auto mt-5 p-5 lg:w-4/5">
        <h2 class="w-full text-center text-2xl">
            POSTS
        </h2>
        <x-list.list itemtemplate='components.posts.small' :items="$posts->map($list_lambda)" />
    </section>

</x-app-layout>
