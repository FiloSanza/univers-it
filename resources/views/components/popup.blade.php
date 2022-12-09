@props([
    'name'
])

{{-- TODO: close on click outside modal --}}

<!-- The Modal -->
<div name="{{$name}}" class="z-10 fixed top-0 left-0 w-full h-full bg-stone-600/50 hidden">

    <!-- Modal content -->
    <div class="bg-gray-100 w-2/5 mx-auto my-20 p-2 rounded-2xl">
        <div class="font-bold text-2xl border-gray-600 border-b-2">
            {{-- TODO: JS --}}
            <span 
                id="{{$name.'-close'}}" 
                class="text-red-600 float-right" 
                onclick="document.getElementsByName('{{ $name }}')[0].style.display = 'none'"
            >
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