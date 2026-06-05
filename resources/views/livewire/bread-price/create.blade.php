@props(['title' => 'إضافة سعر جديد', 'backLink' => 'breadprice.index'])

<x-livewire.page :title="$title" :backLink="$backLink">



    @if (session()->has('message'))
        <div class="bg-green-700/30 border border-green-600 text-green-200 px-4 py-3 rounded-lg text-center">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-lg p-6">
        <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-3 gap-4">



            <div>
                <label class="block mb-1 font-semibold text-gray-200">النوع</label>
                <input type="text" wire:model="type"
                    class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                @error('type')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold text-gray-200">سعر الرغيف</label>
                <input type="number" step="0.01" min="0" wire:model="price"
                    class="w-full p-3 border border-gray-600 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                @error('price')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
            <div class="md:col-span-3">
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold p-3 rounded-lg transition">
                    حفظ
                </button>
            </div>

        </form>
    </div>

    </div>
    </div>
    </div>
</x-livewire.page>
