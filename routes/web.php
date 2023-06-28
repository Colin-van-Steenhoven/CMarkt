<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;
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



Auth::routes();

Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('/create',[PageController::class, 'create'])->name('create-task');
Route::post('/create', [PageController::class, 'save'])->name('save-task');

Route::get('/login', function(){
	return redirect('/amoclient/redirect');
})->name('login');

Route::get('/amoclient/ready', function(){
	return redirect('/');
});