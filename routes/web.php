<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillboardController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\MapController;
use App\Http\Middleware\AdminAuthenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', [BillboardController::class, 'index'])->name('index');
Route::get('/billboard/{slug}', [BillboardController::class, 'show'])->name('billboard.show');
Route::redirect('/billboard', '/');
Route::view('/map', 'map')->name('map');
Route::get('/map/{slug}', [MapController::class, 'show'])->name('map.show');
Route::get('/contribute', [ContributionController::class, 'index'])->name('contribute');
Route::post('/contribute', [ContributionController::class, 'store'])->name('contribute.store');

Route::get('/admin/', [AdminController::class, 'show'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/admin/billboard', [AdminController::class, 'create'])->name('admin.create')->middleware(AdminAuthenticate::class);
Route::post('/admin/billboard', [AdminController::class, 'store'])->name('admin.store')->middleware(AdminAuthenticate::class);