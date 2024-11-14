<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Set application locale to Indonesian
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        // $date = Carbon::now();
        $specificMonth = Carbon::create(2024, 4, 1);
        $currentYear = $specificMonth->year;
        $currentMonth = $specificMonth->month;
        $bulan = $specificMonth->translatedformat('F');
        // Fetch data from the database
        // $data = Berita::whereRaw('YEAR(tanggal_post) = ? AND MONTH(tanggal_post) = ?', [$currentYear, $currentMonth])
        //     ->with('category')->orderBy('tanggal_post', 'asc')->get();
        $totalData = Berita::whereRaw('YEAR(tanggal_post) = ? AND MONTH(tanggal_post) = ?', [$currentYear, $currentMonth])
            ->count();
        $dataBulanan = Berita::whereRaw('YEAR(tanggal_post) = ? AND MONTH(tanggal_post) = ?', [$currentYear, $currentMonth])
            ->get();
        $dataTahunan = Berita::whereRaw('YEAR(tanggal_post) = ?', [$currentYear])
            ->get();
        // $this->create($data);

        return view('dashboard/berita')->with(compact('dataBulanan', 'totalData', 'bulan', 'currentYear', 'dataTahunan'));
    }

    public function exportTahunan()
    {
        return view('dashboard/export-excel-tahunan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function exportBulanan()
    {
        return view('dashboard/export-excel-bulanan');
        // $data = Session::get('data');
        // return dd($data);
        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // // Set application locale to Indonesian
        // // setlocale(LC_TIME, 'id_ID');
        // // Carbon::setLocale('id');
        // // // $date = Carbon::now();
        // // $specificMonth = Carbon::create(2024, 9, 1);
        // // $currentYear = $specificMonth->year;
        // // $currentMonth = $specificMonth->month;
        // // $data = Berita::whereRaw('YEAR(tanggal_post) = ? AND MONTH(tanggal_post) = ?', [$currentYear, $currentMonth])
        // //     ->get();
        // $sheet->setTitle('Berita'); // This is where you set the title
        // $sheet->setCellValue('A1', 'No'); // This is where you set the column header
        // $sheet->setCellValue('B1', 'Judul'); // This is where you set the column header
        // $sheet->setCellValue('C1', 'Kategori'); // This is where you set the column header
        // $sheet->setCellValue('D1', 'Tanggal Post'); // This is where you set the column header
        // $sheet->setCellValue('E1', 'Link'); // This is where you set the column header
        // $row = 2; // Initialize row counter

        // // This is the loop to populate data
        // foreach ($data as $i) {
        //     $sheet->setCellValue('A' . $row, $row - 1);
        //     $sheet->setCellValue('B' . $row, $i->title);
        //     $sheet->setCellValue('C' . $row, $i->category->nama);
        //     $sheet->setCellValue('D' . $row, $i->tanggal_post);
        //     $sheet->setCellValue('E' . $row, 'https://lubuklinggaukota.go.id/public/detilberita/' . $i->id . $i->title);
        //     $row++;
        // }

        // $writer = new Xlsx($spreadsheet);
        // $fileName = 'Your First Excel Exported From Laravel.xlsx';
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header("Content-Disposition: attachment;filename=\"$fileName\"");
        // $writer->save('php://output');
        // exit();
        // return response()->download('filename');
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
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        //
    }
}
