<div class="min-h-screen bg-gray-900 text-gray-100 p-6 flex justify-center">

    <div class="max-w-5xl w-full space-y-6">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-white">تعديل البطاقة</h1>
            <a href="{{ route('cards.index') }}"
                class="bg-gray-600 hover:bg-gray-500 text-white font-semibold px-6 py-3 rounded-lg transition">
                العودة لقائمة البطاقات
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-lg p-6">

            <h2 class="text-lg font-semibold mb-4 text-gray-200">تحديث بيانات البطاقة</h2>

            <form wire:submit.prevent="update" class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <!-- Cardholder Name -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-300">اسم صاحب البطاقة</label>
                    <input type="text" wire:model="name"
                        class="w-full px-3 py-3 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Number of Members -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-300">عدد الأفراد</label>
                    <input type="number" wire:model="members"
                        class="w-full px-3 py-3 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    @error('members')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Number of free_bread_per_month -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-300">عدد العيش الحر شهريا</label>
                    <input type="number" wire:model="free_bread_per_month"
                        class="w-full px-3 py-3 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    @error('free_bread_per_month')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex items-end col-span-3">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-6 py-3 rounded-lg transition">
                        تحديث البطاقة
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
