<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Profile Picture</h2>
        <p class="mt-1 text-sm text-gray-600">Update your account's profile picture.</p>
    </header>

    <div class="mt-6 space-y-6">
        <img src="{{ route('image.get', $user->propic) }}" class="w-24 h-24 rounded-full" alt="{{$user->name}} profile picture." />
    </div>

    <form method="POST" action="{{ route('profile.updatePropic') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')
        <div>
            <x-input-label for="image" :value="__('Image')" class="hidden" />
            <input type="file" 
                class="block w-full text-sm 
                file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                file:text-sm file:font-semibold file:bg-blue-100
                hover:file:bg-gray-100" 
                name="image"
                id="image"
                required />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'image-updated')
                <p id="image-updated" class="text-sm text-gray-600">Saved.</p>
            @endif
        </div>
    </form> 

</section>