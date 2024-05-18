<?php

use App\Http\Controllers\ManagerPrice;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [ManagerPrice::class, 'index'])->name('dashboard');
Route::post('/store', [ManagerPrice::class, 'store'])->name('store');
Route::put('/edit', [ManagerPrice::class, 'edit'])->name('edit');
Route::delete('/delete', [ManagerPrice::class, 'destroy'])->name('remove');
