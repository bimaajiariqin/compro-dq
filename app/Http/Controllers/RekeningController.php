<?php

namespace App\Http\Controllers;

use App\Models\RekeningDonasi;
use App\Models\WebsiteVisit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RekeningController extends Controller
{
    public function index(Request $request): View
    {
        $this->trackVisit($request);

        $rekeningByKategori = RekeningDonasi::orderBy('nama_bank')
            ->get()
            ->groupBy('kategori');

        $visitorStats = [
            'hari_ini'  => (int) (WebsiteVisit::whereDate('visit_date', today())->value('count') ?? 0),
            'bulan_ini' => (int) WebsiteVisit::whereYear('visit_date', now()->year)
                ->whereMonth('visit_date', now()->month)
                ->sum('count'),
            'tahun_ini' => (int) WebsiteVisit::whereYear('visit_date', now()->year)->sum('count'),
        ];

        return view('rekening-donasi', [
            'rekeningByKategori' => $rekeningByKategori,
            'visitorStats'       => $visitorStats,
        ]);
    }

    private function trackVisit(Request $request): void
    {
        $today = today()->toDateString();

        if ($request->session()->get('dq_last_visit_date') === $today) {
            return;
        }

        $visit = WebsiteVisit::firstOrCreate(
            ['visit_date' => $today],
            ['count' => 0]
        );
        $visit->increment('count');

        $request->session()->put('dq_last_visit_date', $today);
    }
}