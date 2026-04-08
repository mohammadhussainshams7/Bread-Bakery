<?php

use Livewire\Component;

new class extends Component {
    public $open = false; // لتبديل القائمة في الموبايل

    public function toggleMenu()
    {
        $this->open = !$this->open;
    }
};
?>
<nav class="bg-gray-900 text-gray-100 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="text-xl font-bold hover:text-yellow-400 transition duration-200">
                    إدارة المخبز
                </a>
            </div>

            <!-- Desktop Menu -->
            <ul class="hidden md:flex space-x-6">
                <li><a href="{{ route('cards.index') }}"
                        class="{{ request()->routeIs('cards.*') ? 'text-yellow-400 font-semibold' : 'hover:text-yellow-400' }} transition duration-200">إدارة
                        البطاقات</a></li>
                <li><a href="{{ route('payments.index') }}"
                        class="{{ request()->routeIs('payments.*') ? 'text-yellow-400 font-semibold' : 'hover:text-yellow-400' }} transition duration-200">تسجيل
                        المدفوعات</a></li>
                <li><a href="{{ route('breadprice.index') }}"
                        class="{{ request()->routeIs('breadprice.*') ? 'text-yellow-400 font-semibold' : 'hover:text-yellow-400' }} transition duration-200">إدارة
                        أسعار الخبز</a></li>
                <li><a href="{{ route('unpaid-cards.index') }}"
                        class="{{ request()->routeIs('unpaid-cards.*') ? 'text-yellow-400 font-semibold' : 'hover:text-yellow-400' }} transition duration-200">البطاقات
                        التي لم تدفع</a></li>
                <li><a href="{{ route('months.index') }}"
                        class="{{ request()->routeIs('months.*') ? 'text-yellow-400 font-semibold' : 'hover:text-yellow-400' }} transition duration-200">إدارة
                        الشهور</a></li>
                <li><a href="{{ route('sell-free-bread.index') }}"
                        class="{{ request()->routeIs('sell-free-bread.*') ? 'text-yellow-400 font-semibold' : 'hover:text-yellow-400' }} transition duration-200">بيع
                        العيش الحر</a></li>
                <li><a href="{{ route('buyingbread.index') }}"
                        class="{{ request()->routeIs('buyingbread.*') ? 'text-yellow-400 font-semibold' : 'hover:text-yellow-400' }} transition duration-200">شراء
                        الخبز يومياً</a></li>

                <li class="flex items-center gap-3">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-red-400">
                                تسجيل الخروج
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">دخول</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-300">تسجيل</a>
                        @endif
                    @endauth
                </li>
            </ul>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button wire:click="toggleMenu" class="focus:outline-none p-2 rounded hover:bg-gray-800 transition">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden mt-2" style="{{ $open ? 'display:block;' : 'display:none;' }}">
            <ul class="flex flex-col space-y-1">
                <li><a href="{{ route('cards.index') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-800 transition">إدارة البطاقات</a></li>
                <li><a href="{{ route('payments.index') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-800 transition">تسجيل المدفوعات</a></li>
                <li><a href="{{ route('breadprice.index') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-800 transition">إدارة أسعار الخبز</a></li>
                <li><a href="{{ route('unpaid-cards.index') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-800 transition">البطاقات التي لم تدفع</a></li>
                <li><a href="{{ route('months.index') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-800 transition">إدارة الشهور</a></li>
                <li><a href="{{ route('sell-free-bread.index') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-800 transition">بيع العيش الحر</a></li>
                <li><a href="{{ route('buyingbread.index') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-800 transition">شراء الخبز يومياً</a></li>
                <li class="flex items-center gap-2">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-red-400">تسجيل
                                الخروج</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">دخول</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-300">تسجيل</a>
                        @endif
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
