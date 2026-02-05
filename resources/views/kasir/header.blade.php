@props(['title' => 'Dashboard', 'breadcrumbs' => []])

<header class="bg-white border-b px-6 py-4">
    <div class="flex items-center justify-between">
        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <a href="{{ route('kasir.dashboard') }}" class="hover:text-purple-700">CetakKu</a>
            @if(count($breadcrumbs) > 0)
                @foreach($breadcrumbs as $breadcrumb)
                    <span>></span>
                    @if(isset($breadcrumb['url']))
                        <a href="{{ $breadcrumb['url'] }}" class="hover:text-purple-700">{{ $breadcrumb['label'] }}</a>
                    @else
                        <span class="text-gray-900 font-medium">{{ $breadcrumb['label'] }}</span>
                    @endif
                @endforeach
            @else
                <span>></span>
                <span class="text-gray-900 font-medium">{{ $title }}</span>
            @endif
        </div>

        {{-- User Info / Actions (optional) --}}
        <div class="flex items-center gap-4">
            {{-- Add notification, profile, etc here if needed --}}
        </div>
    </div>
</header>