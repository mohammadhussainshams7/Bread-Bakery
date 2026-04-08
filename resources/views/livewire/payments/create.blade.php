<div class="min-h-screen bg-gray-900 text-gray-100 p-6">

    <div class="max-w-6xl mx-auto space-y-6">

        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white">تسجيل المدفوعات</h1>

            <a href="{{ route('payments.index') }}" class="text-gray-400 hover:text-white">← رجوع</a>
        </div>
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            {{ session('message') }}
        </div>
        <!-- ✅ COPY YOUR FORM EXACTLY HERE (no change) -->
        <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-lg p-6">
            <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

                <!-- Card Search -->
                <div class="max-w-md mx-auto relative" x-data="{ open: false }" @click.away="open=false">
                    <label class="block mb-1 font-semibold text-gray-200">الاسم</label>
                    <input type="text" wire:model.live="cardSearch" @focus="open=true"
                        placeholder="ابحث عن البطاقة..."
                        class="w-full px-4 py-3 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

                    <div x-show="open" x-transition
                        class="mt-2 border border-gray-700 rounded-lg shadow-lg bg-gray-800 max-h-60 overflow-y-auto z-50">

                        @forelse($this->getFilteredCards() as $card)
                            <div wire:click="selectCard({{ $card->id }})" @click="open=false"
                                class="px-4 py-3 hover:bg-blue-700 cursor-pointer transition flex justify-between items-center text-gray-100">
                                <span>{{ $card->name }}</span>
                                <span class="text-gray-400 text-sm">{{ $card->number ?? '' }}</span>
                            </div>
                        @empty
                            <div class="px-4 py-2 text-gray-400">لا توجد نتائج</div>
                        @endforelse

                    </div>
                </div>

                <!-- Month Selection -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-200">الشهر</label>
                    <select wire:model.live="selectedMonth"
                        class="w-full px-3 py-3 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option value="">اختر الشهر</option>
                        @foreach ($months as $month)
                            <option value="{{ $month->id }}">
                                {{ $arbMonths[$month->month_number] }} / {{ $month->year }}
                            </option>
                        @endforeach
                    </select>
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
                <div>
                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full md:w-auto bg-blue-600 hover:bg-blue-500 text-white font-semibold px-6 py-3 rounded-lg transition flex justify-center items-center gap-2">
                        <span wire:loading.remove>تسجيل الدفع</span>
                        <span wire:loading>⏳ جاري الحفظ...</span>
                    </button>
                </div>


            </form>
        </div>

    </div>
</div>
