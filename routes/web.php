<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\TimeTableController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExcuseController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\AttendanceController;


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

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate'])->name('auth');
Route::post('/logout', [AuthController::class,  'logout'])->name('logout');


Route::middleware(['prevent', 'auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'login_successfully'])->name('home.masterpage');

    // Programas
    Route::get('programa', [ProgramController::class, 'index'])->name('program.index');
    Route::post('programa', [ProgramController::class, 'store'])->name('program.store');
    Route::put('programa/{program}', [ProgramController::class, 'update'])->name('program.update');
    Route::delete('programa/{program}', [ProgramController::class, 'destroy'])->name('program.destroy');

    // Fichas
    Route::get('ficha', [FichaController::class, 'index'])->name('ficha.index');
    Route::post('ficha', [FichaController::class, 'store'])->name('ficha.store');
    Route::put('ficha/{ficha}', [FichaController::class, 'update'])->name('ficha.update');
    Route::delete('ficha/{ficha}', [FichaController::class, 'destroy'])->name('ficha.destroy');
    Route::post('ficha/addAprendiz', [FichaController::class, 'addAprendiz'])->name('ficha.addAprendiz');
    Route::get('/members_list/{fichaId}', [FichaController::class, 'index_Aprendiz'])->name('ficha.index_members');
    Route::get('ficha/{ficha}/export-excel', [FichaController::class, 'exportExcel'])->name('ficha.export.excel');

    //Horarios
    Route::get('timeTable', [TimeTableController::class, 'index'])->name('timeTable.index');
    Route::post('timeTable', [TimeTableController::class, 'store'])->name('timeTable.store');
    Route::put('timeTable/{timeTable}', [TimeTableController::class, 'update'])->name('timeTable.update');
    Route::delete('timeTable/{timeTable}', [TimeTableController::class, 'destroy'])->name('timeTable.destroy');


    // Usuarios
    Route::get('user', [UserController::class , 'index'])->name('user.index');
    Route::post('user', [UserController::class , 'store'])->name('user.store');
    Route::put('user/{user}', [UserController::class , 'update'])->name('user.update');
    Route::delete('user/{user}', [UserController::class , 'destroy'])->name('user.destroy');
    Route::get('user/profile', [UserController::class , 'showProfile'])->name('user.profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    

    //excuse
    Route::get('excuse', [ExcuseController::class , 'index'])->name('excuse.index');
    Route::post('excuse', [ExcuseController::class , 'store'])->name('excuse.store');
    Route::put('excuse/{excuse}', [ExcuseController::class , 'update'])->name('excuse.update');
    Route::delete('excuse/{excuse}', [ExcuseController::class , 'destroy'])->name('excuse.destroy');

    //competence
    Route::get('competence', [CompetenceController::class , 'index'])->name('competence.index');
    Route::post('competence', [CompetenceController::class , 'store'])->name('competence.store');
    Route::put('competence/{competence}', [CompetenceController::class , 'update'])->name('competence.update');
    Route::delete('competence/{competence}', [CompetenceController::class , 'destroy'])->name('competence.destroy');

    // Attendance

    Route::get('attendance', [AttendanceController::class , 'index'])->name('attendance.index');
    Route::post('attendance', [AttendanceController::class , 'store'])->name('attendance.store');
    Route::put('attendance/{attendance}', [AttendanceController::class , 'update'])->name('attendance.update');
    Route::delete('attendance/{attendance}', [AttendanceController::class , 'destroy'])->name('attendance.destroy');



});
