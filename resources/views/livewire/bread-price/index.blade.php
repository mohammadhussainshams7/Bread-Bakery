<div class="min-h-screen bg-gray-900 text-gray-100 p-6">
    <div class="max-w-5xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-white">إدارة أسعار الخبز</h1>
            <a href="{{ route('breadprice.create') }}" class="bg-blue-600 px-4 py-2 rounded text-white">إضافة جديد</a>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-700/30 border border-green-600 text-green-200 px-4 py-3 rounded-lg text-center">
                {{ session('message') }}
            </div>
        @endif

        <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-lg overflow-x-auto">
            <div class="p-4 border-b border-gray-700">
                <h2 class="font-semibold text-gray-200">قائمة الأسعار</h2>
            </div>

            <table class="w-full text-center table-auto">
                <thead class="bg-gray-700 text-gray-200">
                    <tr>
                        <th class="p-3 border border-gray-600">سعر الرغيف</th>
                        <th class="p-3 border border-gray-600">النوع</th>
                        <th class="p-3 border border-gray-600">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($records as $record)
                        <tr class="hover:bg-gray-700/40 transition">
                            <td class="p-3 border border-gray-600 font-semibold text-green-400">{{ $record->price }}
                            </td>
                            <td class="p-3 border border-gray-600">{{ $record->type }}</td>
                            <td class="p-3 border border-gray-600 flex justify-center gap-2">
                                <a href="{{ route('breadprice.update', $record->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-400 text-black px-3 py-1 rounded-lg text-sm">تعديل</a>
                                <a href="{{ route('breadprice.delete', $record->id) }}"
                                    class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded-lg text-sm">حذف</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-4 text-gray-400 border border-gray-600">لا توجد بيانات</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
