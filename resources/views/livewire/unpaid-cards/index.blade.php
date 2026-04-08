<div class="min-h-screen bg-gray-900 text-gray-100 p-6">
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- البحث والفلاتر -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">

            <input type="text" wire:model.live="search" placeholder="ابحث باسم البطاقة"
                class="border border-gray-600 bg-gray-800 rounded px-3 py-2 w-full md:w-1/3 focus:outline-none">

            <select wire:model.live="selectedMonthSearch"
                class="border border-gray-600 bg-gray-800 rounded px-3 py-2 w-full md:w-1/4">
                <option value="">اختر الشهر</option>
                @foreach ($months as $month)
                    <option value="{{ $month->id }}">
                        {{ $arbMonths[$month->month_number] }} / {{ $month->year }}
                    </option>
                @endforeach
            </select>

            <select wire:model.live="statusFilter"
                class="border border-gray-600 bg-gray-800 rounded px-3 py-2 w-full md:w-1/4">
                <option value="">كل الحالات</option>
                <option value="غير مدفوع">غير مدفوع</option>
                <option value="دفع جزء">دفع جزء</option>
            </select>

        </div>

        <!-- جدول البيانات -->
        <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-lg overflow-x-auto">

            <table class="w-full text-center table-auto border border-gray-600">
                <thead class="bg-gray-700 text-gray-200">
                    <tr>
                        <th class="px-4 py-3 border border-gray-600">الاسم</th>
                        <th class="px-4 py-3 border border-gray-600">الحالة</th>
                        <th class="px-4 py-3 border border-gray-600">الإجمالي</th>
                        <th class="px-4 py-3 border border-gray-600">المدفوع</th>
                        <th class="px-4 py-3 border border-gray-600">المتبقي</th>
                    </tr>
                </thead>

                <tbody class="bg-gray-900 divide-y divide-gray-700">

                    @forelse($cards as $card)
                        @if ($card->status != 'تم الدفع')
                            <tr class="hover:bg-gray-800 transition">
                                <td class="px-4 py-2 border">{{ $card->name }}</td>
                                <td class="px-4 py-2 border">
                                    <span
                                        class="px-2 py-1 rounded text-white text-sm
                                        {{ $card->status == 'غير مدفوع'
                                            ? 'bg-red-600'
                                            : ($card->status == 'دفع جزء'
                                                ? 'bg-yellow-500'
                                                : 'bg-green-600') }}">
                                        {{ $card->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 border">{{ number_format($card->total, 2) }}</td>
                                <td class="px-4 py-2 border">{{ number_format($card->paid, 2) }}</td>
                                <td class="px-4 py-2 border">{{ number_format($card->remaining, 2) }}</td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-400 border border-gray-600">
                                لا توجد بيانات
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $cards->links() }}
        </div>

    </div>
</div>
