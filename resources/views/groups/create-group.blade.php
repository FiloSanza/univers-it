<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Group
        </h2>
    </x-slot>

    <form>
        <x-input-label for="name">
            Group Name
        </x-input-label>
        <x-text-input 
            id="name" 
            name="name"
            type="text"
            class="block mt-1 w-full"
            required />
        <x-input-label for="description">
            Group Description
        </x-input-label>
        <x-textarea 
            id="description" 
            rows="4"
            maxlength="500"
            class="block mt-1 w-full" 
            placeholder="Insert a short description..." />
        <x-primary-button>
            Confirm
        </x-primary-button>
    </form>
</x-app-layout>