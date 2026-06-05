@props(['title' => 'إضافة عملية شراء خبز', 'backLink' => 'buyingbread.index'])

<x-livewire.page :title="$title" :backLink="$backLink">

    <!-- MESSAGE -->
    @if (session()->has('message'))
        <div class="bg-green-700/30 p-3 rounded text-center">
            {{ session('message') }}
        </div>
    @endif

    <!-- FORM -->
    <form wire:submit.prevent="save" class="bg-gray-800 p-6 rounded-xl space-y-4 border border-gray-700">

        <!-- NAME -->
        <div>
            <label>الاسم</label>
            <input type="text" wire:model="name" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            @error('name')
                <span class="text-red-400">{{ $message }}</span>
            @enderror
        </div>

        <!-- MEMBERS -->
        <div>
            <label>عدد الأفراد</label>
            <input type="number" wire:model.live="members" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
        </div>

        <!-- DAYS -->
        <div>
            <label>عدد الأيام</label>
            <input type="number" wire:model.live="countdays"
                class="w-full p-2 rounded bg-gray-700 border border-gray-600">
        </div>



        <!-- TOTAL -->
        <div class="bg-gray-700 p-3 rounded text-center text-lg">
            الإجمالي: <strong>{{ $total }}</strong>
        </div>

        <!-- SUBMIT -->
        <button type="submit" class="w-full bg-blue-600 py-2 rounded text-white">
            حفظ
        </button>

    </form>
    </div>
    </div>
</x-livewire.page>
