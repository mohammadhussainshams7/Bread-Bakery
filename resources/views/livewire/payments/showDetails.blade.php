<x-livewire.page>

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-4xl font-bold">بيانات البطاقة</h1>
            <p class="text-2xl text-gray-300 mt-2">{{ $datacard->name }}</p>
        </div>
        <a href="{{ route('payments.index') }}" class="bg-gray-600 px-4 py-2 rounded-lg text-white hover:bg-gray-700">
            العودة
        </a>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-gradient-to-br from-blue-900 to-blue-800 p-6 rounded-lg border border-blue-700">
            <p class="text-gray-300 text-sm">الإجمالي المطلوب</p>
            <p class="text-3xl font-bold text-white mt-2">{{ number_format($totalRequired) }}</p>
        </div>

        <div class="bg-gradient-to-br from-green-900 to-green-800 p-6 rounded-lg border border-green-700">
            <p class="text-gray-300 text-sm">الإجمالي المدفوع</p>
            <p class="text-3xl font-bold text-green-400 mt-2">{{ number_format($totalPaid) }}</p>
        </div>

        <div class="bg-gradient-to-br from-red-900 to-red-800 p-6 rounded-lg border border-red-700">
            <p class="text-gray-300 text-sm">الإجمالي المتبقي</p>
            <p class="text-3xl font-bold text-red-400 mt-2">{{ number_format($totalRemaining) }}</p>
        </div>
    </div>

    <!-- Details Table -->
    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-x-auto">
        <table class="w-full text-center">
            <thead class="bg-gray-700">
                <tr>
                    <th class="p-4">#</th>
                    <th class="p-4">الشهر</th>
                    <th class="p-4">السنة</th>
                    <th class="p-4">المطلوب</th>
                    <th class="p-4">المدفوع</th>
                    <th class="p-4">المتبقي</th>
                    <th class="p-4">الحالة</th>
                </tr>
            </thead>

            <tbody class="text-2xl">
                @forelse ($paymentDetails as $detail)
                    <tr class="border-t border-gray-700 hover:bg-gray-700/40">
                        <td class="p-4">{{ $loop->index + 1 }}</td>
                        <td class="p-4 font-semibold">{{ $detail->month_name }}</td>
                        <td class="p-4">{{ $detail->month_year }}</td>
                        <td class="p-4">{{ number_format($detail->total) }}</td>
                        <td class="p-4 text-green-400 font-semibold">
                            {{ number_format($detail->paid) }}
                        </td>
                        <td class="p-4 text-red-400 font-semibold">
                            {{ number_format($detail->remaining) }}
                        </td>
                        <td class="p-4">
                            <span class="{{ $detail->styleClassStatus }} p-3">
                                {{ $detail->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-gray-400">
                            لا توجد بيانات دفعات
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-livewire.page>
