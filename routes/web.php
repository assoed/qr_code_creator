<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('main_page');
});
Route::get('/about', function () {
    return view('about');
});

use App\Http\Controllers\QRCodeController;
//поменять название функции
Route::post('/process-form', [QRCodeController::class,'process_form'])->name('process.form');


Route::post('/download-png', [QRCodeController::class, 'download_png'])->name('download.png');

use App\Http\Controllers\QRCodeConversionController;
//Route::post('/convert','QRCodeConversionController@convertSVG');
Route::post('/convert', [QRCodeConversionController::class, 'convertSVG'])->name('convert.svg');
