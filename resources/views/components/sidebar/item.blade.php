@props(['label', 'route', 'icon'])

@php
    $active = request()->routeIs($route . '*');
@endphp

<a href="{{ route($route) }}"
    class="flex items-center gap-3 px-3 py-2 rounded-md transition
            {{ $active ? 'bg-purple-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">

    <img src="{{ asset('assets/icons/' . $icon) }}" alt="{{ $label }} icon"
        class="w-4 h-4 object-contain
            {{ $active ? 'brightness-0 invert' : '' }}" />

    <span>{{ $label }}</span>
</a>
