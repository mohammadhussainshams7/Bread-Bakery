<x-layouts::app :title="$title ?? null">
    <div class="min-h-screen bg-gray-900 text-gray-100 p-6">
        <div class="max-w-6xl mx-auto space-y-6">
            {{ $slot }}
        </div>
    </div>
</x-layouts::app>
