<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->middleware(['auth'])->name('beranda');
    Route::get('/datanelayan', [AdminController::class, 'datanelayan']);
    Route::post('/tambahboat',[AdminController::class,'tambahboat']);
    Route::delete('/boat/{data}',[AdminController::class,'hapusboat']);
    Route::post('/editboat',[AdminController::class,'editboat']);
    
    Route::post('/tambahdatanelayan',[AdminController::class,'tambahdatanelayan']);
    Route::delete('/nelayan/{id}',[AdminController::class,'hapusnelayan']);
    Route::post('/editnelayan/{id}',[AdminController::class,'editnelayan']);
});
// Route::get('/', [AdminController::class, 'index'])->middleware(['auth'])->name('beranda');
// Route::get('/', [AdminController::class, 'index'])->middleware(['auth'])->name('beranda');

require __DIR__.'/auth.php';
