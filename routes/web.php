<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/api-data', [ApiController::class, 'index']);
Route::get('/', function () {
    return view('welcome');
});

Route::get('/generate-pdf', [DashboardController::class, 'generatePdf']);
Route::get('/pie-chart', [PieController::class, 'pieChart']);
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/export-excel-bulanan', [BeritaController::class, 'exportBulanan']);
Route::get('/export-excel-tahunan', [BeritaController::class, 'exportTahunan']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
