<div class="min-h-screen bg-gray-900 text-gray-100 p-6">
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white">تعديل الدفعة</h1>

            <a href="{{ route('payments.index') }}" class="text-gray-400 hover:text-white">← رجوع</a>
        </div>

        <!-- Flash Message -->
        @if (session()->has('message'))
            <div class="bg-green-600 text-white font-semibold px-6 py-3 rounded-lg">
                {{ session('message') }}
            </div>
        @endif

        <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-lg p-6">

            <form wire:submit.prevent="updatePayment" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">

                <!-- Card Name (readonly) -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-200">الاسم</label>
                    <input type="text" value="{{ $payment->card->name ?? '-' }}" readonly
                        class="w-full px-4 py-3 rounded-lg bg-gray-700 border border-gray-600 text-gray-300 cursor-not-allowed">
                </div>

                <!-- Month (readonly) -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-200">الشهر</label>
                    <input type="text"
                        value="{{ $arbMonths[$payment->month->month_number] ?? '-' }} / {{ $payment->month->year ?? '-' }}"
                        readonly
                        class="w-full px-4 py-3 rounded-lg bg-gray-700 border border-gray-600 text-gray-300 cursor-not-allowed">
                </div>

                <!-- Paid Amount -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-200">المبلغ المدفوع</label>
                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                        wire:model.defer="paidAmount" placeholder="ادخل المبلغ المدفوع"
                        class="w-full px-3 py-3 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <div class="text-sm mt-1 text-gray-400">
                        المبلغ المتبقي:
                        <span class="text-red-500 font-bold">{{ number_format($remainingAmount) }}</span>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="md:col-span-3">
                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full md:w-auto bg-blue-600 hover:bg-blue-500 text-white font-semibold px-6 py-3 rounded-lg transition flex justify-center items-center gap-2">
                        <span wire:loading.remove>تحديث الدفع</span>
                        <span wire:loading>⏳ جاري الحفظ...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
