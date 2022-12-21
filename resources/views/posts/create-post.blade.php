@php
    /** @var $group '\App\Models\Group' */
@endphp

<x-app-layout>
    <div class="text-center items-center border-b-2 border-gray-600 p-3">
        <h1 class="font-bold text-l md:text-2xl ">
            NEW POST  ({{ $group->name }})
        </h1>
    </div>
    
    <form action="/create-post" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mt-2 mb-6 flex flex-col justify-center items-center">
            <x-input-label for="title">
                Post Title
            </x-input-label>
            <x-text-input 
                id="title" 
                name="title"
                type="text"
                class="block p-2.5 w-full text-md text-gray-900 bg-gray-50 md:text-lg"
                required />
        </div>
        <div class="mt-2 mb-6 flex flex-col justify-center items-center">
            <x-input-label for="content">
                Post Content
            </x-input-label>
            <x-textarea 
                id="content" 
                name="content"
                rows="4"
                class="block p-2.5 w-full text-md text-gray-900 bg-gray-50 md:text-lg" 
                placeholder="Insert the post's content..."
                required/>
        </div>
        <div class="mt-2 mb-6 flex flex-col justify-center items-center">
            <x-input-label for="image">
                Image (Optional)
            </x-input-label>
            <input
                type="file"
                name="image"
                id="image"
                class="block text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 md:text-lg cursor-pointer focus:outline-none"/>
        </div>
        <input type="hidden" name="group_id" value="{{ $group->id }}" />
        <div class="flex flex-col items-center">
            <x-primary-button class="hover:text-gray-900 hover:bg-blue-100 hover:border-indigo-500 hover:ring-indigo-500">
                Confirm
            </x-primary-button>
        </div>
    </form>
</x-app-layout>