<?php

namespace App\Providers;

use App\Models\WebsiteVisit;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Bind $visitorStats otomatis ke setiap view partials.footer,
        // jadi controller mana pun yang render footer nggak perlu
        // hitung/kirim variabel ini manual lagi.
        View::composer('partials.footer', function ($view) {
            $view->with('visitorStats', [
                'hari_ini'  => (int) (WebsiteVisit::whereDate('visit_date', today())->value('count') ?? 0),
                'bulan_ini' => (int) WebsiteVisit::whereYear('visit_date', now()->year)
                    ->whereMonth('visit_date', now()->month)
                    ->sum('count'),
                'tahun_ini' => (int) WebsiteVisit::whereYear('visit_date', now()->year)
                    ->sum('count'),
            ]);
        });
    }
}   