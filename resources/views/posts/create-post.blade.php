@php
    /** @var $group '\App\Models\Group' */
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>
    
    <form action="/create-post" method="post" enctype="multipart/form-data">
        @csrf
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $group->name }} - New Post
            </h2>
        </x-slot>
        <x-input-label for="title">
            Post Title
        </x-input-label>
        <x-text-input 
            id="title" 
            name="title"
            type="text"
            class="block mt-1 w-full"
            required />
        <x-input-label for="content">
            Post Content
        </x-input-label>
        <x-textarea 
            id="content" 
            name="content"
            rows="4"
            class="block mt-1 w-full" 
            placeholder="Insert the post's content..."
            required/>
        <x-input-label for="image">
            Image (Optional)
        </x-input-label>
        <input type="file" name="image" id="image" />
        <input type="hidden" name="group_id" value="{{ $group->id }}" />
        <x-primary-button>
            Confirm
        </x-primary-button>
    </form>
</x-app-layout>