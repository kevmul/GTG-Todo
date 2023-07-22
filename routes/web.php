<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\SubTaskController;

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
    return view('welcome');
});

Route::get('/todos', [TodosController::class, 'index'])->name('todo.index');
Route::post('/todo', [TodosController::class, 'store'])->name('todo.store');
Route::patch('/todo/{todo}/mark/{progress}', [TodosController::class, 'progress'])->name('todo.progress.update');
Route::patch('/todo/{todo}', [TodosController::class, 'update'])->name('todo.update');
Route::delete('/todo/{todo}', [TodosController::class, 'archive'])->name('todo.archive');

Route::post('/subtask/{type}/{type_id}',  [SubTaskController::class, 'store'])->name('subtask.store');
