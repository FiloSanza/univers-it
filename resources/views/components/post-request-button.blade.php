@props([ 'route', 'parameters' ])

@php($id = $attributes->get('id'))

<div>
    {{-- TODO: Use better js --}}
    <a href="{{ $route }}" onclick="event.preventDefault(); document.getElementById('{{ $id }}').submit();" class='{{ $attributes->get('class') }}' >
        {{ $slot }}
    </a>

    <form id="{{ $id }}" action="{{ $route }}" method="post" class="hidden">
        @csrf
        @foreach ($parameters as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
        @endforeach
    </form>
</div>