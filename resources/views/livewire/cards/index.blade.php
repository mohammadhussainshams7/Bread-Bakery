@props(['title' => 'إدارة البطاقات', 'link' => 'cards.create'])

<x-livewire.page :title="$title" :link="$link">

    <div>
        <!-- Header -->

        <livewire:cards.import />
        <!-- Search -->
        <input type="text" wire:model.live.debounce.400ms="search" placeholder="ابحث باسم صاحب البطاقة"
            class="w-full px-3 py-3 mt-5  mb-3 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />

        <!-- Table Card -->
        <div class="bg-gray-800 border mt-3 border-gray-700 rounded-xl shadow-lg overflow-x-auto">

            <div class="p-4 border-b border-gray-700">
                <h2 class="font-semibold text-gray-200">قائمة البطاقات</h2>
            </div>

            <table class="min-w-full text-center table-auto">
                <thead class="bg-gray-700 text-gray-200">
                    <tr>
                        <th class="px-4 py-3 border border-gray-600">الاسم</th>
                        <th class="px-4 py-3 border border-gray-600">عدد الأفراد</th>
                        <th class="px-4 py-3 border border-gray-600">عدد العيش الحر شهريا</th>
                        <th class="px-4 py-3 border border-gray-600">الإجراءات</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-700">

                    @forelse($cards as $card)
                        <tr class="hover:bg-gray-700/40 transition">
                            <td class="px-4 py-3 border border-gray-600 font-medium">{{ $card->name }}</td>
                            <td class="px-4 py-3 border border-gray-600">{{ $card->members }}</td>
                            <td class="px-4 py-3 border border-gray-600">{{ $card->free_bread_per_month }}</td>
                            <td class="px-4 py-3 border border-gray-600 flex justify-center gap-2">

                                <a wire:navigate href="{{ route('cards.edit', $card) }}"
                                    class="bg-yellow-500 hover:bg-yellow-400 text-black px-3 py-1 rounded-lg text-sm">
                                    تعديل
                                </a>

                                <button wire:click="delete({{ $card->id }})"
                                    onclick="confirm('هل أنت متأكد؟') || event.stopImmediatePropagation()"
                                    class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded-lg text-sm">
                                    حذف
                                </button>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-gray-400 border border-gray-600">
                                لا توجد بطاقات
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <!-- Pagination -->
            <div class="p-4">
                {{ $cards->links() }}
            </div>

        </div>
</x-livewire.page>
