@props(['title' => 'إدارة الأشهر', 'link' => 'months.create'])

<x-livewire.page :title="$title" :link="$link">


    <div class="bg-gray-800 border border-gray-700 mt-5 rounded-xl shadow-lg overflow-x-auto">
        <table class="w-full text-center table-auto border border-gray-600">
            <thead class="bg-gray-700 text-gray-200">
                <tr>
                    <th class="px-4 py-3 border border-gray-600">ID</th>
                    <th class="px-4 py-3 border border-gray-600">اسم الشهر</th>
                    <th class="px-4 py-3 border border-gray-600">السنة</th>
                    <th class="px-4 py-3 border border-gray-600">عدد أيام الشهر</th>
                    <th class="px-4 py-3 border border-gray-600">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="bg-gray-900 divide-y divide-gray-700">
                @forelse($months as $month)
                    <tr class="hover:bg-gray-800 transition">
                        <td class="px-4 py-3 border border-gray-600">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 border border-gray-600">{{ $arbMonths[$month->month_number] }}</td>
                        <td class="px-4 py-3 border border-gray-600">{{ $month->year }}</td>
                        <td class="px-4 py-3 border border-gray-600">{{ $month->number_of_days_in_the_month }}</td>
                        <td class="px-4 py-3 border border-gray-600 flex justify-center gap-2">
                            <a wire:navigate href="{{ route('months.edit', $month->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-400 text-black px-3 py-1 rounded-lg">تعديل</a>
                            <button wire:click="delete({{ $month->id }})"
                                onclick="confirm('هل أنت متأكد من حذف هذا الشهر؟') || event.stopImmediatePropagation()"
                                class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded-lg">
                                حذف
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-400 border border-gray-600">
                            لا توجد بيانات بعد.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
</x-livewire.page>
