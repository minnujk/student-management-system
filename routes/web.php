<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MarkController;


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

Route::get('/', function () {
    return redirect('/home');
});
Route::get('/home',  [HomeController::class,'index'])->name('home.index');
Route::get('/students',  [StudentController::class,'index'])->name('student.index');
Route::get('/students/create',  [StudentController::class,'create'])->name('student.create');
Route::post('/students',  [StudentController::class,'store'])->name('student.store');
Route::get('/student/{id}/edit', [StudentController::class,'edit'])->name('student.edit');
Route::put('/student/{id}', [StudentController::class,'update'])->name('student.update');
Route::delete('/student/{id}', [StudentController::class,'destroy'])->name('student.destroy');

Route::get('/marks',  [MarkController::class,'index'])->name('mark.index');
Route::get('/marks/create',  [MarkController::class,'create'])->name('mark.create');
Route::post('/marks',  [MarkController::class,'store'])->name('mark.store');
Route::get('/mark/{id}/edit', [MarkController::class,'edit'])->name('mark.edit');
Route::put('/mark/{id}', [MarkController::class,'update'])->name('mark.update');
Route::delete('/mark/{id}', [MarkController::class,'destroy'])->name('mark.destroy');