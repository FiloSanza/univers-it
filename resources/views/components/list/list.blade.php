{{-- 

Items must be an eloquent collection like the one below:

$items = [
    [ 'group' => $group, 'user' => $user ],
    [ 'group' => $group, 'user' => $user ]
]

each element is a list item, which is represented by an array, as a key the name of the prop.

--}}

@props([ 
    'itemtemplate',
    'items' => [],
    'ordered' => false,
    'emptymsg' => "Nothing to see here."
])

@if($ordered)
<ul>
@else
<ol>
@endif
    @includeWhen($items->isEmpty(), 'components.list.empty', [ 'value' => $emptymsg ])
    @foreach ($items as $item)
        @include('components.list.item', [ 'template' => $itemtemplate, 'params' => $item ])
    @endforeach
@if($ordered)
</ul>
@else
</ol>
@endif