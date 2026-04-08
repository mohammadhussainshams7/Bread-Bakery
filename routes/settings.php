<?php

use App\Livewire\Cards\Create;
use App\Livewire\Cards\Edit;
use App\Livewire\Cards\Index;
use App\Livewire\Month\MonthIndex;
use App\Livewire\Month\MonthCreate;
use App\Livewire\Month\MonthEdit;
// استيراد Livewire Components مع alias لتفادي التعارض
use App\Livewire\Payments\Index as PaymentsIndex;
use App\Livewire\Payments\Create as PaymentsCreate;
use App\Livewire\Payments\Update as PaymentsUpdate;
use App\Livewire\Payments\Delete as PaymentsDelete;

use App\Livewire\BreadPrice\Create as BreadPriceCreate;
use App\Livewire\BreadPrice\Index as BreadPriceIndex;
use App\Livewire\BreadPrice\Update as BreadPriceUpdate;
use App\Livewire\BreadPrice\Delete as BreadPriceDelete;

use App\Livewire\UnpaidCards\Index as UnpaidCardsIndex;


use App\Livewire\BuyingBreadByTheDay\Index as BuyingBreadIndex;
use App\Livewire\BuyingBreadByTheDay\Create as BuyingBreadCreate;
use App\Livewire\BuyingBreadByTheDay\Update as BuyingBreadUpdate;
use App\Livewire\BuyingBreadByTheDay\Delete as BuyingBreadDelete;
use App\Livewire\FreeBreadSales\FreeBreadSales;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified', 'throttle:60,1'])->group(function () {

    Route::name('cards.')->group(function () {

        // الصفحة الرئيسية /
        Route::get('/', Index::class)->name('index');

        // باقي الصفحات
        Route::prefix('cards')->group(function () {

            Route::get('/create', Create::class)->name('create');

            Route::get('/{card}/edit', Edit::class)->name('edit');
        });
    });
    Route::prefix('months')->name('months.')->group(function () {
        Route::get('/', MonthIndex::class)->name('index');
        Route::get('/create', MonthCreate::class)->name('create');
        Route::get('/{id}/edit', MonthEdit::class)->name('edit');
        Route::delete('/{id}', MonthIndex::class . '@delete')->name('destroy');
    });
    Route::prefix('payments')->name('payments.')->group(function () {

        // صفحة عرض المدفوعات
        Route::get('/', PaymentsIndex::class)->name('index');

        // صفحة إضافة دفعة جديدة
        Route::get('/create', PaymentsCreate::class)->name('create');

        // صفحة تعديل دفعة (باستخدام parameter id)
        Route::get('/update/{payment}', PaymentsUpdate::class)->name('update');

        // صفحة حذف دفعة (اختياري، غالبًا عبر Livewire مباشرة)
        Route::get('/delete/{paymentId}', PaymentsDelete::class)->name('delete');
    });


    Route::prefix('breadprice')->name('breadprice.')->group(function () {

        Route::get('/', BreadPriceIndex::class)->name('index');          // breadprice.index
        Route::get('/create', BreadPriceCreate::class)->name('create');  // breadprice.create
        Route::get('/update/{id}', BreadPriceUpdate::class)->name('update'); // breadprice.update
        Route::get('/delete/{id}', BreadPriceDelete::class)->name('delete'); // breadprice.delete

    });

    /*  Route::livewire('breadprice', 'pages::breadprice.breadprice')->name('breadprice'); */
    /*  Route::livewire('unpaid-cards', 'pages::payments.unpaid-cards')->name('unpaid-cards'); */
    Route::prefix('unpaid-cards')->name('unpaid-cards.')->group(function () {
        Route::get('/', UnpaidCardsIndex::class)->name('index');
    });

    Route::prefix('sell-free-bread')->name('sell-free-bread.')->group(function () {
        Route::get('/', FreeBreadSales::class)->name('index');
    });

    Route::prefix('buyingbread')->name('buyingbread.')->group(function () {
        Route::get('/', BuyingBreadIndex::class)->name('index');
        Route::get('/create', BuyingBreadCreate::class)->name('create');
        Route::get('/update/{id}', BuyingBreadUpdate::class)->name('update');
        Route::get('/delete/{buyingBreadByTheDay}', BuyingBreadDelete::class)->name('delete');
    });
});

Route::get('/', fn() => redirect()->route('cards.index'));
Route::get('/home', fn() => redirect()->route('cards.index'));
