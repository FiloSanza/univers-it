@props([ 'route', 'parameters' ])

@php($id = $attributes->get('id'))

<div>
    {{-- TODO: Use better js --}}
    <a 
        href="{{ $route }}" 
        onclick="event.preventDefault(); document.getElementById('{{ $id }}').submit();"
        class='{{ $attributes->get('class') }}' 
    >
        {{ $slot }}
    </a>

    {{-- TODO: Use better css --}}
    <form id="{{ $id }}" action="{{ $route }}" method="post" style="display: none;">
        @csrf
        @foreach ($parameters as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
        @endforeach
    </form>
</div>