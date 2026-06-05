@props(['title' => null, 'link' => null, 'backLink' => null])

<div class="min-h-screen bg-gray-900 text-gray-100 p-6">
    @if ($title || $link || $backLink)
        <div class="flex items-center justify-between mb-5 p-3">
            @if ($title)
                <h1 class="text-3xl font-bold text-white">{{ $title }}</h1>
            @endif

            @if ($link)
                <a wire:navigate href="{{ route($link) }}"
                    class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold">
                    + اضافة جديد
                </a>
            @endif

            @if ($backLink)
                <a href="{{ route($backLink) }}"
                    class="bg-gray-700 hover:bg-gray-800 px-4 py-2 rounded text-white">رجوع</a>
            @endif
        </div>
    @endif

    {{ $slot }}
</div>
