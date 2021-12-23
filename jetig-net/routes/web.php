<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;

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


Route::middleware('guest')->group(static function () {
    Route::get('register', fn() => view('guest.register'));
    Route::get('login', fn() => view('guest.login'))->name('login');
    Route::get('contacts', fn() => view('guest.contacts'))->name('contacts');

    Route::post('register', [GuestController::class, 'register']);
    Route::post('login', [GuestController::class, 'login']);


});

Route::middleware('auth')->group(static function () {
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/', fn() => view('welcome'))->name('home');
    Route::get('contacts', fn() => view('contacts'))->name('contacts');
    Route::get('excel/view', [ExcelController::class, 'index'])->name('index');
    Route::get('excel/export', [ExcelController::class, 'export'])->name('export');
    Route::post('excel/import', [ExcelController::class, 'import'])->name('import');
});
