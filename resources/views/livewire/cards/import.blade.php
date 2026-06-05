{{-- <x-livewire.page> --}}
<div>

    <button wire:click="import" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white">
        استيراد من Excel
    </button>
    <div wire:loading.flex wire:target="import"
        class="fixed top-20 left-1/2 -translate-x-1/2 bg-blue-600 text-white px-5 py-3 rounded-xl shadow-lg items-center gap-3">
        <div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>

        <span>جاري استيراد البيانات...</span>
    </div>
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition>
            {{ session('success') }}
        </div>
    @endif
</div>
{{-- </x-livewire.page> --}}
