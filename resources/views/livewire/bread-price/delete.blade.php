<div class="min-h-screen bg-gray-900 text-gray-100 p-6 flex items-center justify-center">
    <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-lg p-6 max-w-md w-full text-center">
        <h2 class="text-lg text-gray-200 font-bold mb-4">تأكيد الحذف</h2>
        <p class="mb-4 text-gray-300">هل أنت متأكد أنك تريد حذف هذا السعر؟</p>
        <div class="flex justify-center gap-4">
            <button wire:click="delete" class="bg-red-600 px-4 py-2 rounded text-white">حذف</button>
            <a href="{{ route('breadprice.index') }}" class="bg-gray-600 px-4 py-2 rounded text-white">إلغاء</a>
        </div>
    </div>
</div>
