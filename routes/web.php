<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\FichaController;


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

Route::get('/' , [AuthController::class , 'login'] )->name('login');
Route::post('/auth', [AuthController::class , 'authenticate'])->name('auth');
Route::post('/logout' , [AuthController::class ,  'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'login_successfully'])->name('home.masterpage');

    //rutas de programas
    Route::get('programa', [ProgramController::class, 'index'])->name('program.index');
    Route::post('programa', [ProgramController::class, 'store'])->name('program.store');
    Route::put('programa/{program}', [ProgramController::class, 'update'])->name('program.update');
    Route::delete('programa/{program}', [ProgramController::class, 'destroy'])->name('program.destroy');

    // Fichas
    Route::get('ficha', [FichaController::class, 'index'])->name('ficha.index');
    Route::post('ficha', [FichaController::class, 'store'])->name('ficha.store');
    Route::get('ficha/create', [FichaController::class, 'create'])->name('ficha.create');
    Route::delete('ficha/{ficha}', [FichaController::class, 'destroy'])->name('ficha.destroy');
});
