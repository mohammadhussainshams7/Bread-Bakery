<x-layouts::auth :title="__('تسجيل')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('إنشاء حساب')" :description="__('أدخل بياناتك أدناه لإنشاء حسابك')" />

        <!-- حالة الجلسة -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <!-- الاسم -->
            <flux:input name="name" :label="__('الاسم')" :value="old('name')" type="text" required autofocus
                autocomplete="name" :placeholder="__('الاسم الكامل')" />

            <!-- عنوان البريد الإلكتروني -->
            <flux:input name="email" :label="__('عنوان البريد الإلكتروني')" :value="old('email')" type="email"
                required autocomplete="email" placeholder="email@example.com" />

            <!-- كلمة المرور -->
            <flux:input name="password" :label="__('كلمة المرور')" type="password" required autocomplete="new-password"
                :placeholder="__('كلمة المرور')" viewable />

            <!-- تأكيد كلمة المرور -->
            <flux:input name="password_confirmation" :label="__('تأكيد كلمة المرور')" type="password" required
                autocomplete="new-password" :placeholder="__('تأكيد كلمة المرور')" viewable />

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                    {{ __('إنشاء حساب') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('هل لديك حساب؟') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('تسجيل الدخول') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
