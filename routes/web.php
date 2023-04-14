<?php

use App\Http\Controllers\TodosController;
use Illuminate\Support\Facades\Route;

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
Route::patch('/todo/{todo_id}/mark/completed', [TodosController::class, 'complete'])->name('todo.complete');
Route::patch('/todo/{todo}', [TodosController::class, 'update'])->name('todo.update');
Route::delete('/todo/{todo}', [TodosController::class, 'archive'])->name('todo.archive');
