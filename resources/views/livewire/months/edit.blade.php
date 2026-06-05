@props(['title' => 'تعديل الشهر', 'backLink' => 'months.index'])

<x-livewire.page :title="$title" :backLink="$backLink">


    @if (session()->has('message'))
        <div class="bg-green-700 border border-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-lg p-6 flex flex-col md:flex-row gap-4 items-end">
        <select wire:model="month_number" class="px-4 py-3 rounded-lg border bg-gray-700">
            @foreach ($arbMonths as $k => $v)
                <option value="{{ $k }}">{{ $v }}</option>
            @endforeach
        </select>
        <select wire:model="year" class="px-4 py-3 rounded-lg border bg-gray-700">
            @for ($y = 2026; $y <= 2090; $y++)
                <option value="{{ $y }}">{{ $y }}</option>
            @endfor
        </select>
        <input type="number" wire:model="number_of_days_in_the_month" readonly
            class="px-4 py-3 rounded-lg border bg-gray-700" placeholder="عدد أيام الشهر" />
        <button wire:click="update" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">تحديث</button>
    </div>

    </div>
    </div>
</x-livewire.page>
