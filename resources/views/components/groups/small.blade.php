@props([ 'group' ])

<div class="flex flex-row items-center p-1 hover:bg-gray-200 hover:rounded-xl">
    <div class="flex flex-row">
        <img src="{{ route('image.get', $group->image_id) }}" class="w-12 rounded-full h-12 mx-2 my-2" alt="{{ $group->name }}" />
        <a href="{{ route('group.show', $group->name) }}" class="font-bold my-5"> 
            {{ $group->name }} 
        </a>
    </div>
</div>