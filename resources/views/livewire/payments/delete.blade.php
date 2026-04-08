<div class="bg-gray-800 p-6 rounded-xl shadow-lg">

    <!-- زر الحذف -->
    <button type="button" wire:click="confirmDelete"
        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded transition duration-200">
        حذف الدفعة
    </button>

    <!-- Full Screen Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70">
            <div class="bg-gray-800 rounded-xl shadow-lg w-full max-w-lg mx-4 p-6">
                <h2 class="text-2xl font-bold text-white mb-4">تأكيد حذف الدفعة</h2>
                <p class="text-gray-200 mb-6">
                    هل أنت متأكد من حذف هذه الدفعة؟ هذه العملية لا يمكن التراجع عنها!
                </p>
                <div class="flex justify-end gap-3">
                    <button wire:click="$set('showModal', false)"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded transition duration-200">
                        إلغاء
                    </button>
                    <button wire:click="deletePayment"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded transition duration-200">
                        حذف
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="mt-4 p-2 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

</div>
