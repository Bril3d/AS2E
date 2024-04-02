<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;


Route::get('/appointments', [AppointmentController::class, 'index']);
Route::get('/appointments/filter', [AppointmentController::class, 'filter']);
Route::post('/appointments/new', [AppointmentController::class, 'store']);
Route::put('/appointments/{appointment}', [AppointmentController::class, 'update']);
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy']);
