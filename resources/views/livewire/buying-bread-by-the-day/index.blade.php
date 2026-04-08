<div class="min-h-screen bg-gray-900 text-gray-100 p-6">
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- HEADER -->
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-white">شراء الخبز اليومي</h1>

            <a href="{{ route('buyingbread.create') }}" class="bg-blue-600 px-4 py-2 rounded text-white">
                إضافة جديد
            </a>
        </div>

        <!-- MESSAGE -->
        @if (session()->has('message'))
            <div class="bg-green-700/30 border border-green-600 text-green-200 px-4 py-3 rounded-lg text-center">
                {{ session('message') }}
            </div>
        @endif

        <!-- TABLE -->
        <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-lg overflow-x-auto">
            <table class="w-full text-center table-auto">
                <thead class="bg-gray-700 text-gray-200">
                    <tr>
                        <th class="p-3 border border-gray-600">الاسم</th>
                        <th class="p-3 border border-gray-600">الأيام</th>
                        <th class="p-3 border border-gray-600">الأفراد</th>
                        <th class="p-3 border border-gray-600">الإجمالي</th>
                        <th class="p-3 border border-gray-600">الإجراءات</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-700">
                    @forelse($records as $record)
                        <tr class="hover:bg-gray-700/40 transition">
                            <td class="p-3 border border-gray-600">{{ $record->name }}</td>
                            <td class="p-3 border border-gray-600">{{ $record->countdays }}</td>
                            <td class="p-3 border border-gray-600">{{ $record->members }}</td>
                            <td class="p-3 border border-gray-600">{{ $record->total }}</td>

                            <td class="p-3 border border-gray-600 flex justify-center gap-2">

                                <!-- EDIT -->
                                <a href="{{ route('buyingbread.update', $record->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-400 text-black px-3 py-1 rounded-lg text-sm">
                                    تعديل
                                </a>

                                <!-- DELETE -->
                                <button onclick="confirm('متأكد؟') || event.stopImmediatePropagation()"
                                    wire:click="delete({{ $record->id }})"
                                    class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded-lg text-sm">
                                    حذف
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-gray-400 border border-gray-600">
                                لا توجد بيانات
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
