@props(['title' => 'التقرير الشهري'])

<x-livewire.page :title="$title">
    <div class="min-h-screen bg-slate-950 text-slate-100">
        <div class="space-y-8 p-5">
            <!-- Header Section with Background -->
            <div class="relative overflow-hidden">
                <div
                    class="relative flex flex-col gap-8 md:flex-row md:items-end md:justify-between rounded-3xl border border-slate-800 bg-slate-900/95 p-8 shadow-2xl shadow-black/40">
                    <div>
                        <div
                            class="inline-flex items-center gap-2 rounded-full bg-cyan-500/10 px-4 py-2 mb-4 text-cyan-200">
                            <span class="text-sm font-semibold">📊 التقرير الشهري</span>
                        </div>
                        <h1 class="text-4xl font-bold text-white">تقرير شهر
                            {{ $report['month'] ? ($arbMonths[$report['month']->month_number] ?? $report['month']->month_number) . ' ' . $report['month']->year : '---' }}
                        </h1>
                        <p class="mt-2 text-sm text-slate-400">نظرة شاملة على المبيعات والمستحقات والمدفوعات</p>
                    </div>

                    <div class="w-full max-w-sm">
                        <label class="block text-sm font-bold text-slate-300 mb-3">📅 اختر الشهر:</label>
                        <select wire:model.lazy="selectedMonthId"
                            class="w-full rounded-2xl border border-slate-700 bg-slate-950/90 px-4 py-3 text-slate-100 font-semibold focus:border-cyan-500 focus:outline-none transition-colors shadow-sm cursor-pointer">
                            @forelse($months as $month)
                                <option value="{{ $month->id }}">
                                    {{ $arbMonths[$month->month_number] ?? $month->month_number }} {{ $month->year }}
                                </option>
                            @empty
                                <option value="">لا يوجد أشهر</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>

            <!-- Bread Sales Section -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-0.5 w-8 bg-cyan-400"></div>
                    <h2 class="text-xl font-bold text-white">📊 عدد الخبز المباع</h2>
                </div>
                <div class="grid gap-8 md:grid-cols-3">
                    <!-- Card Sales -->
                    <div class="relative">
                        <div
                            class="rounded-3xl border border-slate-800 bg-slate-900/90 p-6 text-slate-100 shadow-lg shadow-black/20 hover:border-cyan-500 transition-all duration-200">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class=" font-bold   text-slate-400">بيع بالبطاقة</p>
                                    <p class="mt-2 text-4xl font-bold text-cyan-300">
                                        {{ number_format($report['cardBreadSold']) }}</p>
                                </div>
                                <div class="text-5xl">🎫</div>
                            </div>
                            <div class="pt-3 border-t border-slate-800">
                                <p class=" text-slate-500">أرغفة الخبز المباعة عبر البطاقات</p>
                            </div>
                        </div>
                    </div>

                    <!-- Cash Sales -->
                    <div class="relative">
                        <div
                            class="rounded-3xl border border-slate-800 bg-slate-900/90 p-6 text-slate-100 shadow-lg shadow-black/20 hover:border-emerald-500 transition-all duration-200">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class=" font-bold  text-slate-400">بيع نقدي</p>
                                    <p class="mt-2 text-4xl font-bold text-emerald-300">
                                        {{ number_format($report['cashBreadSold']) }}</p>
                                </div>
                                <div class="text-5xl">🍞</div>
                            </div>
                            <div class="pt-3 border-t border-slate-800">
                                <p class=" text-slate-500">أرغفة الخبز المباعة نقداً</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Sales -->
                    <div class="relative">
                        <div
                            class="rounded-3xl border border-slate-800 bg-slate-900/90 p-6 text-slate-100 shadow-lg shadow-black/20 hover:border-violet-500 transition-all duration-200">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class=" font-bold  text-slate-400">الإجمالي</p>
                                    <p class="mt-2 text-4xl font-bold text-violet-300">
                                        {{ number_format($report['totalBreadSold']) }}</p>
                                </div>
                                <div class="text-5xl">📦</div>
                            </div>
                            <div class="pt-3 border-t border-slate-800">
                                <p class=" text-slate-500">إجمالي الأرغفة المباعة</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Status Section -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-0.5 w-8 bg-emerald-400"></div>
                    <h2 class="text-xl font-bold text-white">💳 حالة الدفع</h2>
                </div>
                <div class="grid gap-8 md:grid-cols-3">
                    <!-- Paid -->
                    <div class="relative">
                        <div
                            class="rounded-3xl border border-slate-800 bg-slate-900/90 p-6 text-slate-100 shadow-lg shadow-black/20 hover:border-emerald-500 transition-all duration-200">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class=" font-bold  text-slate-400">مدفوع بالكامل
                                    </p>
                                    <p class="mt-2 text-4xl font-bold text-emerald-300">
                                        {{ number_format($report['paidCount']) }} بطاقة</p>
                                </div>
                                <div class="text-5xl">✅</div>
                            </div>
                            <div class="pt-3 border-t border-slate-800">
                                <p class=" text-slate-500">بطاقات مسددة بالكامل</p>
                            </div>
                        </div>
                    </div>

                    <!-- Partial -->
                    <div class="relative">
                        <div
                            class="rounded-3xl border border-slate-800 bg-slate-900/90 p-6 text-slate-100 shadow-lg shadow-black/20 hover:border-amber-500 transition-all duration-200">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class=" font-bold  text-slate-400">دفع جزئي</p>
                                    <p class="mt-2 text-4xl font-bold text-amber-300">
                                        {{ number_format($report['partialCount']) }} بطاقة</p>
                                </div>
                                <div class="text-5xl">⏳</div>
                            </div>
                            <div class="pt-3 border-t border-slate-800">
                                <p class=" text-slate-500">بطاقات مدفوع جزء منها</p>
                            </div>
                        </div>
                    </div>

                    <!-- Unpaid -->
                    <div class="relative">
                        <div
                            class="rounded-3xl border border-slate-800 bg-slate-900/90 p-6 text-slate-100 shadow-lg shadow-black/20 hover:border-rose-500 transition-all duration-200">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class=" font-bold  text-slate-400">غير مدفوع</p>
                                    <p class="mt-2 text-4xl font-bold text-rose-300">
                                        {{ number_format($report['unpaidCount']) }} بطاقة</p>
                                </div>
                                <div class="text-5xl">❌</div>
                            </div>
                            <div class="pt-3 border-t border-slate-800">
                                <p class=" text-slate-500">بطاقات غير مدفوعة</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Names Summary Section -->
            <div class="rounded-3xl border border-slate-800 bg-slate-900/95 p-6 shadow-2xl shadow-black/20">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-0.5 w-8 bg-cyan-400"></div>
                    <h2 class="text-xl font-bold text-white">🧾 تفاصيل الدفع حسب الأسماء</h2>
                </div>
                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="rounded-3xl border border-slate-800 bg-slate-950/80 p-5">
                        <div class="flex items-center justify-between gap-3 mb-4">
                            <div>
                                <p class="text-sm font-semibold text-emerald-300">مدفوع بالكامل</p>
                                <p class=" text-slate-500">{{ number_format($report['paidCount']) }} بطاقة</p>
                            </div>
                            <span
                                class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-300">✅</span>
                        </div>
                        <ul class="space-y-2 text-sm text-slate-200 max-h-60 overflow-y-auto pr-2">
                            @forelse($report['nameCardsPaid'] ?? [] as $name)
                                <li class="rounded-2xl bg-slate-900/90 px-3 py-2">{{ $name }}</li>
                            @empty
                                <li class="text-slate-500">لا توجد بيانات</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="rounded-3xl border border-slate-800 bg-slate-950/80 p-5">
                        <div class="flex items-center justify-between gap-3 mb-4">
                            <div>
                                <p class="text-sm font-semibold text-amber-300">دفع جزئي</p>
                                <p class=" text-slate-500">{{ number_format($report['partialCount']) }} بطاقة
                                </p>
                            </div>
                            <span
                                class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-amber-500/10 text-amber-300">⏳</span>
                        </div>
                        <ul class="space-y-2 text-sm text-slate-200 max-h-60 overflow-y-auto pr-2">
                            @forelse($report['nameCardsPartial'] ?? [] as $name)
                                <li class="rounded-2xl bg-slate-900/90 px-3 py-2">{{ $name }}</li>
                            @empty
                                <li class="text-slate-500">لا توجد بيانات</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="rounded-3xl border border-slate-800 bg-slate-950/80 p-5">
                        <div class="flex items-center justify-between gap-3 mb-4">
                            <div>
                                <p class="text-sm font-semibold text-rose-300">غير مدفوع</p>
                                <p class=" text-slate-500">{{ number_format($report['unpaidCount']) }} بطاقة</p>
                            </div>
                            <span
                                class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-rose-500/10 text-rose-300">❌</span>
                        </div>
                        <ul class="space-y-2 text-sm text-slate-200 max-h-60 overflow-y-auto pr-2">
                            @forelse($report['nameCardsUnpaid'] ?? [] as $name)
                                <li class="rounded-2xl bg-slate-900/90 px-3 py-2">{{ $name }}</li>
                            @empty
                                <li class="text-slate-500">لا توجد بيانات</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Financial Summary Section -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-1 w-12 bg-linear-to-r from-yellow-500 to-amber-600 rounded-full"></div>
                    <h2 class="text-2xl font-black text-white">💰 الملخص المالي</h2>
                </div>
                <div class="grid gap-8 md:grid-cols-2">
                    <!-- Total Paid Amount -->
                    <div class="group relative">
                        <div
                            class="absolute -inset-0.5 bg-linear-to-r from-green-600 to-emerald-600 rounded-3xl blur opacity-0 group-hover:opacity-25 transition duration-500">
                        </div>
                        <div
                            class="relative rounded-3xl bg-linear-to-br from-green-950/70 via-slate-900 to-green-900/60 p-8 backdrop-blur-xl shadow-2xl hover:shadow-green-500/20 transition-all duration-300 group">
                            <div class="flex items-start justify-between mb-6">
                                <div>
                                    <p class="text-sm font-bold text-green-300 uppercase tracking-wide">المبلغ المدفوع
                                    </p>
                                    <p class="mt-4 text-7xl font-black text-green-400">
                                        {{ number_format($report['totalPaid']) }} جنيه</p>
                                </div>
                                <div
                                    class="text-8xl text-green-500/20 group-hover:text-green-500/40 transition-all duration-300">
                                    💚</div>
                            </div>
                            <div class="pt-4 border-t border-green-500/20">
                                <p class="text-sm text-slate-400">ما تم تحصيله من المستحقات</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Unpaid Amount -->
                    <div class="group relative">
                        <div
                            class="absolute -inset-0.5 bg-linear-to-r from-red-600 to-pink-600 rounded-3xl blur opacity-0 group-hover:opacity-25 transition duration-500">
                        </div>
                        <div
                            class="relative rounded-3xl bg-linear-to-br from-red-950/70 via-slate-900 to-red-900/60 p-8 backdrop-blur-xl shadow-2xl hover:shadow-red-500/20 transition-all duration-300 group">
                            <div class="flex items-start justify-between mb-6">
                                <div>
                                    <p class="text-sm font-bold text-red-300 uppercase tracking-wide">المبلغ المتبقي
                                    </p>
                                    <p class="mt-4 text-7xl font-black text-red-400">
                                        {{ number_format($report['totalUnpaid']) }} جنيه</p>
                                </div>
                                <div
                                    class="text-8xl text-red-500/20 group-hover:text-red-500/40 transition-all duration-300">
                                    ⚠️</div>
                            </div>
                            <div class="pt-4 border-t border-red-500/20">
                                <p class="text-sm text-slate-400">المبلغ المتبقي على العملاء</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cash Sales Summary -->
            <div class="relative">
                <div
                    class="absolute -inset-0.5 bg-linear-to-r from-emerald-600 via-teal-600 to-cyan-600 rounded-3xl blur opacity-0 hover:opacity-20 transition duration-500">
                </div>
                <div
                    class="relative rounded-3xl bg-linear-to-r from-emerald-950/70 via-slate-900 to-cyan-950/70 p-8 shadow-2xl backdrop-blur-xl">
                    <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="text-sm font-bold text-emerald-300 uppercase tracking-wide">مبيعات نقدية</p>
                            <p class="mt-2 text-6xl font-black text-emerald-400">
                                {{ number_format($report['cashSalesTotal']) }} جنيه</p>
                            <p class="mt-2 text-sm text-slate-400">القيمة الكاملة للمبيعات النقدية المباشرة</p>
                        </div>
                        <div
                            class="rounded-3xl bg-linear-to-br from-slate-700/70 to-slate-900/80 px-10 py-8 text-center shadow-lg">
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-wide">عدد السجلات</p>
                            <p class="mt-3 text-5xl font-black text-white">{{ $report['cashRecordsCount'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-livewire.page>
