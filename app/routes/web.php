<?php

use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::match(['GET', 'DELETE'], '/files', [FileController::class, 'index'])->name('files.index');
Route::post('/upload',  [FileController::class, 'store'])->name('files.store');
Route::get('/files/{id}', [FileController::class, 'show'])->name('files.show');
Route::delete('/files/delete/{id}', [FileController::class, 'destroy'])->name('delete');
Route::get('/download/{id}/{originalName}', [DownloadsController::class, 'index'])->name('downloads.index');

require __DIR__.'/auth.php';
