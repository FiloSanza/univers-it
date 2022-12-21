<x-app-layout>
    <div class="text-center items-center border-b-2 border-gray-600 p-3">
        <h1 class="font-bold text-l md:text-2xl ">
            NEW GROUP
        </h1>
    </div>

    <form action="/create-group" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mt-2 mb-6 flex flex-col justify-center items-center">
            <x-input-label for="name">
                Group Name
            </x-input-label>
            <x-text-input
                type="text" 
                id="name" 
                name="name"
                class="block p-2.5 w-full text-md text-gray-900 bg-gray-50 md:text-lg" 
                required />
        </div>
        <div class="mt-2 mb-6 flex flex-col justify-center items-center">
            <x-input-label for="description" class="mb-2">
                Group Description
            </x-input-label>
            <x-textarea 
                id="description" 
                name="description"
                rows="4"
                maxlength="500"
                class="block p-2.5 w-full text-md text-gray-900 bg-gray-50 md:text-lg" 
                placeholder="Insert a short description..."
                required />
        </div>
        <div class="mt-2 mb-6 flex flex-col justify-center items-center">
            <x-input-label for="image">
                Group Image
            </x-input-label>
            <input 
                type="file"
                name="image"
                id="image"
                class="block text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 md:text-lg cursor-pointer focus:outline-none"
                required />
        </div>
        <div class="flex flex-col items-center">
            <x-primary-button>
                Confirm
            </x-primary-button>
        </div>
    </form>
</x-app-layout>