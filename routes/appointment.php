<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin|moderator'])->group(function () {
  Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
  Route::get('/appointments/filter', [AppointmentController::class, 'filter'])->name('appointments.filter');
  Route::post('/appointments/new', [AppointmentController::class, 'store'])->name('appointments.store');
  Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
  Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.delete');;
});
