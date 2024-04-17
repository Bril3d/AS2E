<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
  Route::delete('/files', [FileController::class, 'destroy'])->name('files.destroy');
  Route::delete('/files/revert/{file}', [FileController::class, 'revert'])->name('files.revert');
  Route::post('/files', [FileController::class, 'upload'])->name('files.upload');
  Route::post('/files/process', [FileController::class, 'process'])->name('files.process');
});
