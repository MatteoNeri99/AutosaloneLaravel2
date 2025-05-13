<?php

use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutoController;
use App\Http\Controllers\MessageController;
use App\Models\Auto;
use App\Models\Message;

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



Route::get('', function () {
    return view('auth.login');
})->name('admin.login');

Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/home', function () {
        $auto = Auto::count();
        return view('home', compact('auto'));
    })->name('admin.home');

    Route::get('/auto/search', [AutoController::class, 'search'])->name('auto.search');
    Route::resource('/auto', AutoController::class);

    Route::get('/cestino', [AutoController::class, 'trashed'])->name('auto.cestino');
    Route::get('/cestino/ripristina/{id}', [AutoController::class, 'restore'])->name('auto.restore');
    Route::get('/cestino/elimina/{id}', [AutoController::class, 'forceDelete'])->name('auto.forceDelete');

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('/admin/messages', [MessageController::class, 'showAdminMessages'])->name('messages')->middleware('auth');

});





