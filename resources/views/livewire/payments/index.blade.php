<div class="min-h-screen bg-gray-900 text-gray-100 p-6">

    <div class="max-w-6xl mx-auto space-y-6">

        <!-- عنوان + زر الإضافة -->
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white">المدفوعات</h1>
            <a href="{{ route('payments.create') }}" class="bg-blue-600 px-4 py-2 rounded-lg text-white">
                + إضافة دفعة
            </a>
        </div>

        <!-- رسالة نجاح -->
        @if (session()->has('success'))
            <div class="bg-green-600 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- بحث بالاسم + فلتر الشهر -->
        <div class="flex flex-col md:flex-row gap-4 mb-4">
            <input type="text" wire:model.live="search" placeholder="ابحث بالاسم..."
                class="w-full md:w-1/3 px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <select wire:model.live="selectedMonthSearch"
                class="w-full md:w-1/4 px-3 py-2 rounded-lg bg-gray-700 border border-gray-600 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">اختر الشهر</option>
                @foreach ($months as $month)
                    <option value="{{ $month->id }}">
                        {{ $arbMonths[$month->month_number] }} / {{ $month->year }}
                    </option>
                @endforeach
            </select>

            <button wire:click="clearFilters" class="bg-gray-600 px-4 py-2 rounded-lg text-white">
                مسح الفلاتر
            </button>
        </div>

        <!-- جدول المدفوعات -->
        <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-lg overflow-x-auto">

            <table class="min-w-full text-center table-auto">
                <thead class="bg-gray-700 text-gray-200">
                    <tr>
                        <th class="px-4 py-3 border border-gray-600">#</th>
                        <th class="px-4 py-3 border border-gray-600">البطاقة</th>
                        <th class="px-4 py-3 border border-gray-600">الشهر</th>
                        <th class="px-4 py-3 border border-gray-600">المطلوب</th>
                        <th class="px-4 py-3 border border-gray-600">المدفوع</th>
                        <th class="px-4 py-3 border border-gray-600">المتبقي</th>
                        <th class="px-4 py-3 border border-gray-600">الحالة</th>
                        <th class="px-4 py-3 border border-gray-600">الاجراء</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-700">

                    @forelse($payments as $payment)
                        @php $status = $this->status($payment); @endphp

                        <tr wire:key="payment-{{ $payment->id }}" class="hover:bg-gray-700/40 transition">
                            <td class="px-4 py-3 border border-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 border border-gray-600">
                                {{ $payment->card ? $payment->card->name : '-' }}
                            </td>
                            <td class="px-4 py-3 border border-gray-600">
                                {{ $payment->month ? $arbMonths[$payment->month->month_number] . ' / ' . $payment->month->year : '-' }}
                            </td>
                            <td class="px-4 py-3 border border-gray-600">{{ number_format($payment->total) }}</td>
                            <td class="px-4 py-3 border border-gray-600">{{ number_format($payment->paid_amount) }}
                            </td>
                            <td class="px-4 py-3 border border-gray-600 text-red-500 font-semibold">
                                {{ number_format($status['remaining']) }}
                            </td>
                            <td class="px-4 py-3 border border-gray-600">
                                <span class="px-3 py-1 rounded-lg text-sm font-semibold {{ $status['color'] }}">
                                    {{ $status['text'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3 border border-gray-600">
                                <a href="{{ route('payments.update', $payment) }}"
                                    class="bg-yellow-500 px-2 py-1 rounded text-white">تعديل</a>
                                <a href="{{ route('payments.delete', $payment->id) }}"
                                    class="bg-red-500 px-2 py-1 m-2 rounded text-white">حذف</a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="p-6 text-gray-400 text-center">
                                لا توجد مدفوعات
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <div class="p-4 text-gray-100">
                {{ $payments->links() }}
            </div>

        </div>
    </div>
</div>
