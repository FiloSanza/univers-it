@props([
    'name'
])

<!-- The Modal -->
<div data-name="{{$name}}" class="popup-body z-10 fixed top-0 left-0 w-full h-full bg-stone-600/50 hidden">
    <!-- Modal content -->
    <div class="bg-gray-100 mx-auto my-20 p-2 rounded-2xl w-full lg:w-2/5">
        <div class="font-bold text-2xl border-gray-600 border-b-2">
            <span class="text-red-600 float-right cursor-pointer" data-target="{{$name}}">
                &times;
            </span>
            @if(isset($header))
                <h2> {{ $header }} </h2>
            @endif
        </div>
        <div>
            {{ $slot }}
        </div>
    </div>
</div>