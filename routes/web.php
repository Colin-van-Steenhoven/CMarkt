<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\Assign;

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



Auth::routes();

Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('/my-tasks',[PageController::class, 'mytasks'])->name('my-tasks');
Route::get('/create',[PageController::class, 'create'])->name('create-task');
Route::post('/create', [PageController::class, 'save'])->name('save-task');
Route::get('/eddit-tasks/{id}', [PageController::class, 'eddit'])->name('eddit-tasks');
Route::post('/eddit-tasks/{id}', [PageController::class, 'edditsave'])->name('eddit-tasks');
Route::get('/delete-task{id}', [PageController::class, 'deletetask'])->name('delete-task');
Route::get('/details{id}',[PageController::class, 'details'])->name('details');
Route::get('/task-users{id}',[PageController::class, 'taskusers'])->name('task-users');
Route::post('/add-points/{id}', [PageController::class, 'addpoints'])->name('add-points');

Route::get('/assign_to_task/{id}',[PageController::class, 'assign_to_task'])->name('assign_to_task');
Route::get('/remove_from_task/{id}',[PageController::class, 'remove_from_task'])->name('remove_from_task');

Route::get('/login', function(){
	return redirect('/amoclient/redirect');
})->name('login');

Route::get('/amoclient/ready', function(){
	return redirect('/');
});