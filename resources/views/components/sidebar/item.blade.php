@props(['label', 'route', 'icon'])

@php
    $active = request()->routeIs($route . '*');
@endphp

<a href="{{ route($route) }}"
    class="flex items-center gap-2 px-3 py-2 rounded transition text-xs
        {{ $active ? 'text-white bg-[#370C5A]' : 'text-gray-700 hover:text-white hover:bg-[#8F3FCF]' }}">

    <img src="{{ asset('assets/icons/' . $icon) }}" 
        alt="{{ $label }} icon"
        class="w-[14px] h-[14px] object-contain {{ $active ? 'brightness-0 invert' : '' }}" />

    <span class="text-[13px]">{{ $label }}</span>
</a>