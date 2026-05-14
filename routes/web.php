<?php

use App\Http\Controllers\ActaController;
use App\Http\Controllers\AttendeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Home');
})->middleware('auth')->name('home');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::resource('actas', ActaController::class);
    Route::post('actas/{acta}/share', [ActaController::class, 'share'])->name('actas.share');
    Route::get('actas/{acta}/download-pdf', [ActaController::class, 'downloadPdf'])->name('actas.download-pdf');
});

// Public routes for shared actas
Route::get('actas/shared/{token}', [AttendeeController::class, 'create'])->name('actas.shared.register');
Route::post('actas/shared/{token}', [AttendeeController::class, 'store'])->name('actas.shared.store');
Route::get('actas/shared/{token}/show', function ($token) {
    $acta = \App\Models\Acta::where('share_token', $token)->with('attendees')->firstOrFail();
    return inertia('Actas/SharedShow', ['acta' => $acta]);
})->name('actas.shared.show');
Route::get('actas/shared/{token}/edit', [AttendeeController::class, 'editShared'])->name('actas.shared.edit');
Route::post('actas/shared/{token}/update', [AttendeeController::class, 'updateShared'])->name('actas.shared.update');
