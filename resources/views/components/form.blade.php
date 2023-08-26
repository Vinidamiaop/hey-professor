@props([
    "action",
    "post" => null,
    "put" => null,
    "delete" => null,
])

<form action="{{ $action }}" method="post">
    @csrf
    @if($put)
        @method("put")
    @endif

    @if($delete)
        @method("delete")
    @endif

    {{ $slot }}

</form>
