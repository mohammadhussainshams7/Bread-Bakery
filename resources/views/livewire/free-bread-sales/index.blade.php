<div class="min-h-screen bg-gray-900 text-gray-100 p-6">
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- Header -->
        <h1 class="text-3xl font-bold text-white">إدارة بيع العيش الحر</h1>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="bg-green-700/30 border border-green-600 text-green-300 px-4 py-3 rounded-lg">
                {{ session('message') }}
            </div>
        @endif

        <!-- Form -->
        <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-lg p-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-200">
                {{ $editId ? 'تعديل عملية البيع' : 'إضافة عملية بيع' }}
            </h2>

            <div class="grid md:grid-cols-2 gap-4">

                <!-- الكمية -->
                <div>
                    <label class="block mb-1 text-gray-300">عدد العيش</label>
                    <input type="number" wire:model.live="sellAmount" min="1"
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- الإجمالي (محسوب تلقائي) -->
                <div class="flex items-end">
                    <div class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3">
                        <p class="text-sm text-gray-400">السعر الإجمالي</p>
                        <p class="text-2xl font-bold text-green-400">
                            {{ $this->totalPrice }} جنيه
                        </p>
                    </div>
                </div>

            </div>

            <button wire:click="save"
                class="mt-5 w-full bg-blue-600 hover:bg-blue-500 transition p-3 rounded-lg font-semibold">
                {{ $editId ? 'تحديث البيع' : 'حفظ البيع' }}
            </button>
        </div>

        <!-- جدول المبيعات -->
        <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-lg overflow-hidden">
            <div class="p-4 border-b border-gray-700">
                <h2 class="font-semibold text-gray-200">سجل المبيعات</h2>
            </div>

            <table class="w-full text-center">
                <thead class="bg-gray-700 text-gray-300">
                    <tr>
                        <th class="p-3">#</th>
                        <th class="p-3">الكمية</th>
                        <th class="p-3">سعر الرغيف</th>
                        <th class="p-3">الإجمالي</th>
                        <th class="p-3">إجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($sales as $sale)
                        <tr class="border-t border-gray-700 hover:bg-gray-700/40 transition">

                            <td class="p-3">{{ $loop->iteration }}</td>

                            <!-- الكمية -->
                            <td class="p-3">{{ $sale->quantity }}</td>

                            <!-- سعر وقت البيع -->
                            <td class="p-3 text-blue-400">
                                {{ $sale->sell_at_price }} جنيه
                            </td>

                            <!-- الإجمالي -->
                            <td class="p-3 text-green-400 font-semibold">
                                {{ $sale->paid_amount }} جنيه
                            </td>

                            <!-- أزرار -->
                            <td class="p-3">
                                <div class="flex justify-center gap-2">

                                    <button wire:click="edit({{ $sale->id }})"
                                        class="bg-yellow-500 hover:bg-yellow-400 text-black px-3 py-1 rounded-lg text-sm">
                                        تعديل
                                    </button>

                                    <button wire:click="delete({{ $sale->id }})"
                                        class="bg-red-600 hover:bg-red-500 px-3 py-1 rounded-lg text-sm"
                                        onclick="confirm('متأكد؟') || event.stopImmediatePropagation()">
                                        حذف
                                    </button>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-gray-400">
                                لا توجد بيانات حالياً
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
