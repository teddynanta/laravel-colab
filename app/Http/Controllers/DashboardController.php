<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Berita;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function generatePdf()
    {
        // Set application locale to Indonesian
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        // $date = Carbon::now();
        $specificMonth = Carbon::create(2024, 7, 1);
        $currentYear = $specificMonth->year;
        $currentMonth = $specificMonth->month;
        $bulan = $specificMonth->translatedformat('F');
        // Fetch data from the database
        $data = Berita::whereRaw('YEAR(tanggal_post) = ? AND MONTH(tanggal_post) = ?', [$currentYear, $currentMonth])
            ->with('category')->orderBy('tanggal_post', 'asc')->get();
        $totalData = Berita::whereRaw('YEAR(tanggal_post) = ? AND MONTH(tanggal_post) = ?', [$currentYear, $currentMonth])
            ->count();
        $doc = Dokumen::whereRaw('YEAR(created_at) = ? AND MONTH(created_at) = ?', [$currentYear, $currentMonth])
            ->with('category')->orderBy('created_at', 'asc')->get();
        $totalDoc = Dokumen::whereRaw('YEAR(created_at) = ? AND MONTH(created_at) = ?', [$currentYear, $currentMonth])
            ->count();

        $news = Berita::whereRaw('YEAR(created_at) = ? AND MONTH(created_at) = ?', [$currentYear, $currentMonth])
            ->select('kategori_berita_id', DB::raw('count(*) as count'))
            ->groupBy('kategori_berita_id')
            ->get();
        // $news = DB::table('news') // Use table name directly
        // ->select('category', DB::raw('count(*) as count'))
        // ->groupBy('category')
        // ->get();

        $totalNews = $news->sum('count');

        $labels = [];
        $datas = [];

        foreach ($news as $item) {
            $labels[] = $item->category;
            // $data[] = round(($item->count / $totalNews) * 100, 2);
            $datas[] = $item->count;
        }
        foreach ($labels as $item) {
            $names[] = $item->nama;
        }

        $chartData = [
            'labels' => $names,
            'datasets' => [
                [
                    'label' => 'Kategori',
                    'data' => $datas,
                    'backgroundColor' => ['#2980b9', '#f39c12', '#9b59b6', '#3498db', '#e74c3c'], // Sample colors
                    'borderColor' => ['#2980b9', '#f39c12', '#9b59b6', '#3498db', '#e74c3c'], // Sample colors
                ]
            ]
        ];

        // Create PDF
        $pdf = new Dompdf();
        $pdf->loadHtml(view('dashboard/pdf_template', compact('data', 'doc', 'bulan', 'totalData', 'totalDoc', 'chartData')));

        // (Optional) Set paper size and orientation
        $pdf->setPaper('A4', 'landscape');

        // Render PDF
        $pdf->render();

        // Output PDF
        // return $pdf->stream('data.pdf');
        // Get the PDF content
        $pdfContent = $pdf->output();

        // Return the PDF content as a response
        return new Response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="data.pdf"',
        ]);
        // return view('dashboard/pdf_template')->with(compact('data', 'doc', 'bulan', 'totalData', 'totalDoc', 'chartData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
