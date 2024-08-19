<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Berita;
use Illuminate\Support\Facades\DB;

class PieController extends Controller
{
    public function pieChart()
    {
        // Set application locale to Indonesian
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        // $date = Carbon::now();
        $specificMonth = Carbon::create(2024, 7, 1);
        $currentYear = $specificMonth->year;
        $currentMonth = $specificMonth->month;
        $bulan = $specificMonth->translatedformat('F');
        $startDate = Carbon::now()->startOfMonth(); // Get beginning of current month
        $endDate = Carbon::now()->endOfMonth(); // Get end of current month

        // $news = Berita::whereRaw('YEAR(tanggal_post) = ? AND MONTH(tanggal_post) = ?', [$currentYear, $currentMonth])
        //     ->groupBy('kategori_berita_id')
        //     ->get();
        // $news = Berita::select('kategori_berita_id', DB::raw('count(*) as count'))
        //     ->whereBetween('created_at', [$startDate, $endDate])
        //     ->groupBy('kategori_berita_id')
        //     ->get();
        $news = Berita::whereRaw('YEAR(created_at) = ? AND MONTH(created_at) = ?', [$currentYear, $currentMonth])
            ->select('kategori_berita_id', DB::raw('count(*) as count'))
            ->groupBy('kategori_berita_id')
            ->orderBy('count', 'desc')
            ->get();
        // $news = DB::table('news') // Use table name directly
        // ->select('category', DB::raw('count(*) as count'))
        // ->groupBy('category')
        // ->get();

        $totalNews = $news->sum('count');

        $labels = [];
        $data = [];

        foreach ($news as $item) {
            $labels[] = $item->category;
            // $data[] = round(($item->count / $totalNews) * 100, 2);
            $data[] = $item->count;
        }
        foreach ($labels as $item) {
            $names[] = $item->nama;
        }

        $chartData = [
            'labels' => $names,
            'datasets' => [
                [
                    'label' => 'Kategori',
                    'data' => $data,
                    'backgroundColor' => ['#557A3E', '#6F954B', '#8DAE6C', '#ABC68D', '#EBAD5C', '#EB9E47', '#E58E2F', '#DE7E17'], // Sample colors
                    'borderColor' => ['#2980b9', '#f39c12', '#9b59b6', '#3498db', '#e74c3c'], // Sample colors
                ]
            ]
        ];

        return view('dashboard/pie-chart', compact('chartData', 'news', 'totalNews', 'bulan'));
    }
}
