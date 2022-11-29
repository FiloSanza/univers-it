{{-- 
    This is the template used to show the post's page.
    This page will show all the infos about the post such as:
        - Group
        - User
        - Comments
        - Title
        - Full post description / image
--}}

@php
    /** @var $post '\App\Models\Post' */
    $group = $post->group()->first();
    $user = $post->user()->first();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>
    
    <br>
    
    <small> Posted in <a href="{{ route('group.show', $group->name) }}"> {{ $group->name }} </a> by <a href="{{ route('userpage.show', $user->name) }}"> {{ $user->name }} </a> </small>
    
    <br>

    <p> {{ $post->content }} </p>

</x-app-layout>
