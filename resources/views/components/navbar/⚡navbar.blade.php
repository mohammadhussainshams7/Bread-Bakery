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
<nav
    class="sticky top-0 z-40 bg-slate-950/95 text-slate-100 shadow-2xl shadow-black/20 backdrop-blur border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <div class="flex items-center justify-between gap-4">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" class="flex  items-center gap-3">
                    <div class="flex items-center gap-3">

                        <div class="flex items-center justify-center rounded-xl  text-slate-950 font-black text-4xl">
                            🌾
                        </div>

                        <div class="flex flex-col leading-none">
                            <span class="text-slate-50 font-extrabold text-lg">
                                أولاد شمس
                            </span>

                        </div>

                    </div>


                    {{-- <div class="text-right leading-tight">
                        <p class="text-lg font-semibold tracking-tight">مخبز اولاد شمس</p>
                        <p class="text-xs text-slate-400">لوحة الإدارة</p>
                    </div> --}}
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-6">
                <ul class="flex items-center gap-4 text-sm font-medium">
                    <li>
                        <a href="{{ route('cards.index') }}"
                            class="rounded-full px-3 py-2 transition duration-200 {{ request()->routeIs('cards.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">إدارة
                            البطاقات</a>
                    </li>
                    <li>
                        <a href="{{ route('payments.index') }}"
                            class="rounded-full px-3 py-2 transition duration-200 {{ request()->routeIs('payments.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">تسجيل
                            المدفوعات</a>
                    </li>
                    <li>
                        <a href="{{ route('breadprice.index') }}"
                            class="rounded-full px-3 py-2 transition duration-200 {{ request()->routeIs('breadprice.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">إدارة
                            أسعار الخبز</a>
                    </li>
                    <li>
                        <a href="{{ route('unpaid-cards.index') }}"
                            class="rounded-full px-3 py-2 transition duration-200 {{ request()->routeIs('unpaid-cards.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">البطاقات
                            التي لم تدفع</a>
                    </li>
                    <li>
                        <a href="{{ route('months.index') }}"
                            class="rounded-full px-3 py-2 transition duration-200 {{ request()->routeIs('months.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">إدارة
                            الشهور</a>
                    </li>
                    <li>
                        <a href="{{ route('sell-free-bread.index') }}"
                            class="rounded-full px-3 py-2 transition duration-200 {{ request()->routeIs('sell-free-bread.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">بيع
                            العيش الحر</a>
                    </li>
                    <li>
                        <a href="{{ route('buyingbread.index') }}"
                            class="rounded-full px-3 py-2 transition duration-200 {{ request()->routeIs('buyingbread.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">شراء
                            الخبز يومياً</a>
                    </li>
                    <li>
                        <a href="{{ route('reportMonth.index') }}"
                            class="rounded-full px-3 py-2 transition duration-200 {{ request()->routeIs('reportMonth.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">تقرير
                            الشهر</a>
                    </li>
                </ul>

                <div class="flex items-center gap-3">
                    @auth
                        <span class="text-sm text-slate-400">مرحباً، {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-rose-500/20 hover:bg-rose-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-rose-400">تسجيل
                                الخروج</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-cyan-500/20 hover:bg-cyan-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-cyan-400">دخول</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="rounded-lg border border-slate-700 bg-slate-900 px-4 py-2 text-sm font-semibold text-slate-200 hover:bg-slate-800 transition duration-200 focus:outline-none focus:ring-2 focus:ring-slate-600">تسجيل</a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button wire:click="toggleMenu" aria-expanded="{{ $open ? 'true' : 'false' }}"
                    class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-700 bg-slate-900/90 text-slate-100 shadow-sm shadow-black/20 transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-cyan-400">
                    @if ($open)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    @endif
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div
            class="md:hidden mt-3 overflow-hidden transition-all duration-300 {{ $open ? 'max-h-[2000px] opacity-100' : 'max-h-0 opacity-0' }}">
            <div
                class="rounded-3xl border border-slate-800 bg-slate-950/95 p-4 shadow-2xl shadow-black/20 backdrop-blur-md">
                <ul class="flex flex-col gap-2 text-sm font-medium">
                    <li>
                        <a href="{{ route('cards.index') }}"
                            class="block rounded-2xl px-4 py-3 transition duration-200 {{ request()->routeIs('cards.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">إدارة
                            البطاقات</a>
                    </li>
                    <li>
                        <a href="{{ route('payments.index') }}"
                            class="block rounded-2xl px-4 py-3 transition duration-200 {{ request()->routeIs('payments.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">تسجيل
                            المدفوعات</a>
                    </li>
                    <li>
                        <a href="{{ route('breadprice.index') }}"
                            class="block rounded-2xl px-4 py-3 transition duration-200 {{ request()->routeIs('breadprice.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">إدارة
                            أسعار الخبز</a>
                    </li>
                    <li>
                        <a href="{{ route('unpaid-cards.index') }}"
                            class="block rounded-2xl px-4 py-3 transition duration-200 {{ request()->routeIs('unpaid-cards.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">البطاقات
                            التي لم تدفع</a>
                    </li>
                    <li>
                        <a href="{{ route('months.index') }}"
                            class="block rounded-2xl px-4 py-3 transition duration-200 {{ request()->routeIs('months.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">إدارة
                            الشهور</a>
                    </li>
                    <li>
                        <a href="{{ route('sell-free-bread.index') }}"
                            class="block rounded-2xl px-4 py-3 transition duration-200 {{ request()->routeIs('sell-free-bread.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">بيع
                            العيش الحر</a>
                    </li>
                    <li>
                        <a href="{{ route('buyingbread.index') }}"
                            class="block rounded-2xl px-4 py-3 transition duration-200 {{ request()->routeIs('buyingbread.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">شراء
                            الخبز يومياً</a>
                    </li>
                    <li>
                        <a href="{{ route('reportMonth.index') }}"
                            class="block rounded-2xl px-4 py-3 transition duration-200 {{ request()->routeIs('reportMonth.*') ? 'bg-cyan-500/15 text-cyan-300' : 'text-slate-300 hover:text-cyan-300 hover:bg-slate-800/80' }}">تقرير
                            الشهر</a>
                    </li>
                </ul>

                <div class="mt-4 flex flex-col gap-3">
                    @auth
                        <span class="text-sm text-slate-400">مرحباً، {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full rounded-2xl bg-rose-600 px-4 py-3 text-sm font-semibold text-white hover:bg-rose-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-rose-400">تسجيل
                                الخروج</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="w-full rounded-2xl bg-cyan-600 px-4 py-3 text-center text-sm font-semibold text-white hover:bg-cyan-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-cyan-400">دخول</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-center text-sm font-semibold text-slate-200 hover:bg-slate-800 transition duration-200 focus:outline-none focus:ring-2 focus:ring-slate-600">تسجيل</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
