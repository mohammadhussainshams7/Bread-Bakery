@props(['title' => 'المدفوعات'])

<x-livewire.page :title="$title">


    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="bg-green-600 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filters -->
    <div>
        <input type="text" wire:model.live.debounce.500ms="search" placeholder="ابحث بالاسم..."
            class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600">
    </div>


    <!-- Table -->
    @if ($search)
        <div class="bg-gray-800 border  border-gray-700 rounded-xl overflow-x-auto">

            <table class="w-full text-center">

                <thead class="bg-gray-700">
                    <tr>
                        <th class="p-3">#</th>
                        <th>البطاقة</th>
                        <th>الشهر</th>
                        <th>المطلوب</th>
                        <th>المدفوع</th>
                        <th>المتبقي</th>
                        <th>الحالة</th>
                        <th>الدفعة</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($searchRows as $row)
                        <tr wire:key="row-{{ $row->key }}" class="border-t border-gray-700 hover:bg-gray-700/40">

                            <td class="p-3">
                                {{ $searchRows->firstItem() + $loop->index }}
                            </td>

                            <td>{{ $row->name }}</td>

                            <td>
                                {{ $arbMonths[$row->month_number] }} / {{ $row->month_year }}
                            </td>

                            <td>{{ number_format($row->total) }}</td>
                            <td>{{ number_format($row->paid) }}</td>

                            <td class="text-red-400 font-semibold">
                                {{ number_format($row->remaining) }}
                            </td>

                            <td>
                                <span class="px-2 py-1 rounded text-sm {{ $row->styleClassStatus }}  ">
                                    {{ $row->status }}
                                </span>
                            </td>

                            <td>
                                <input type="number" placeholder="دفعة جديدة"
                                    wire:model.live.debounce.500ms="paidAmounts.{{ $row->key }}"
                                    class="w-24 px-2 py-1 bg-gray-700 border border-gray-600 rounded text-center">

                                @error("paidAmounts.{$row->key}")
                                    <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </td>

                            <td class="space-x-1">
                                <a wire:navigate href="{{ route('payments.showdetails', $row->card_id) }}"
                                    class="btn   hover:bg-gray-700 p-3 rounded-2xl ">تفاصيل</a>
                            @empty
                        <tr>
                            <td colspan="9" class="p-6 text-gray-400">
                                لا توجد بيانات
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

            <!-- Pagination -->
            <div class="p-4">
                {{ $searchRows->links() }}
            </div>

        </div>
    @else
        <div class="bg-gray-800 border border-gray-700 rounded-xl mt-3 p-12 text-center">
            <p class="text-gray-400 text-lg">
                لا توجد بطاقة تم البحث عليها
            </p>
            <p class="text-gray-500 text-sm mt-2">
                يرجى كتابة اسم البطاقة للبحث
            </p>
        </div>
    @endif
    </div>
    </div>
