@props(['label', 'route', 'icon'])

@php
    $active = request()->routeIs($route . '*');
@endphp

<a href="{{ route($route) }}"
    class="flex items-center gap-2 px-2.5 py-1.5 rounded-md transition text-xs
        {{ $active ? 'text-white bg-secondary' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-100' }}">

    <img src="{{ asset('assets/icons/' . $icon) }}" 
        alt="{{ $label }} icon"
        class="w-3.5 h-3.5 object-contain {{ $active ? 'brightness-0 invert' : '' }}" />

    <span class="text-[13px]">{{ $label }}</span>
</a>