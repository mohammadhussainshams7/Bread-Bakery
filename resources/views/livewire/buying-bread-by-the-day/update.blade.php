<div class="min-h-screen bg-gray-900 text-gray-100 p-6">
    <div class="max-w-3xl mx-auto space-y-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">تعديل عملية شراء</h1>

            <a href="{{ route('buyingbread.index') }}" class="bg-gray-700 px-4 py-2 rounded">
                رجوع
            </a>
        </div>

        <!-- MESSAGE -->
        @if (session()->has('message'))
            <div class="bg-green-700/30 p-3 rounded text-center">
                {{ session('message') }}
            </div>
        @endif

        <!-- FORM -->
        <form wire:submit.prevent="update" class="bg-gray-800 p-6 rounded-xl space-y-4 border border-gray-700">

            <!-- NAME -->
            <div>
                <label>الاسم</label>
                <input type="text" wire:model="name" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            </div>

            <!-- MEMBERS -->
            <div>
                <label>عدد الأفراد</label>
                <input type="number" wire:model.live="members"
                    class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            </div>

            <!-- DAYS -->
            <div>
                <label>عدد الأيام</label>
                <input type="number" wire:model.live="countdays"
                    class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            </div>

            <!-- TOTAL -->
            <div class="bg-gray-700 p-3 rounded text-center text-lg">
                الإجمالي: <strong>{{ $total }}</strong>
            </div>

            <!-- SUBMIT -->
            <button type="submit" class="w-full bg-yellow-500 py-2 rounded text-black">
                تحديث
            </button>

        </form>
    </div>
</div>
