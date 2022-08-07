<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\FindController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', [TodoController::class, 'index'])->middleware(['auth'])->name('dashboard');
// Route::get('/dashboard', function () {
//     return view('index');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';

// Route::get('/', [TodoController::class, 'index'])->middleware('auth');
Route::get('/', [TodoController::class, 'index'])->middleware('auth');

Route::post('/todo/create', [TodoController::class, 'create']);
Route::post('/todo/update', [TodoController::class, 'update']);
Route::post('/todo/delete', [TodoController::class, 'delete']);

Route::get('/todo/find', [FindController::class, 'find']);
Route::post('/todo/search', [FindController::class, 'search']);