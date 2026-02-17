<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\DocumentController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


Route::middleware('auth')->group(function () {

   // Only uploader can upload
    Route::middleware('role:uploader')->group(function () {
        Route::get('/upload', [UploadController::class, 'index']);
        Route::post('/upload', [UploadController::class, 'store']);
    });

     // Only viewer can view documents
    Route::middleware('role:viewer')->group(function () {

        Route::get('/documents', [DocumentController::class, 'index']);

        Route::get('/preview/{document}', [DocumentController::class, 'preview'])
            ->name('preview')
            ->middleware('signed'); 
    });
});
