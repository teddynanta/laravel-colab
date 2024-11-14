<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
$data = Session::get('dataTahunan');
$tahun = Session::get('tahun');
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Berita'); // This is where you set the title
$sheet->setCellValue('A1', 'No'); // This is where you set the column header
$sheet->setCellValue('B1', 'Judul'); // This is where you set the column header
$sheet->setCellValue('C1', 'Kategori'); // This is where you set the column header
$sheet->setCellValue('D1', 'Tanggal Post'); // This is where you set the column header
$sheet->setCellValue('E1', 'Link'); // This is where you set the column header
$row = 2; // Initialize row counter

// This is the loop to populate data
foreach ($data as $i) {
    $sheet->setCellValue('A' . $row, $row - 1);
    $sheet->setCellValue('B' . $row, $i->title);
    $sheet->setCellValue('C' . $row, $i->category->nama);
    $sheet->setCellValue('D' . $row, $i->tanggal_post);
    $sheet->setCellValue('E' . $row, 'https://lubuklinggaukota.go.id/public/detilberita/' . $i->id . $i->title);
    $row++;
}

$writer = new Xlsx($spreadsheet);
$fileName = 'Data Berita Tahun ' . $tahun . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=\"$fileName\"");
$writer->save('php://output');
exit();
?>
