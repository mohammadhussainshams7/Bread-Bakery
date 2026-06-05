<?php

namespace App\Livewire\Concerns;

trait HasArabicMonths
{
    public array $arbMonths = [
        1 => 'يناير',
        2 => 'فبراير',
        3 => 'مارس',
        4 => 'ابريل',
        5 => 'مايو',
        6 => 'يونيو',
        7 => 'يوليو',
        8 => 'اغسطس',
        9 => 'سبتمبر',
        10 => 'اكتوبر',
        11 => 'نوفمبر',
        12 => 'ديسمبر',
    ];

    protected function getPaymentStatusClass(string $status, float $paid = 0): string
    {
        if ($status === 'تم الدفع') {
            return 'bg-green-800';
        }

        if ($paid > 0) {
            return 'bg-gray-800';
        }

        return 'bg-red-800';
    }
}
