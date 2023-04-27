<?php

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

Route::get('/',[\App\Http\Controllers\MainController::class, 'home'])->name('home');
Route::get('/about', [\App\Http\Controllers\MainController::class, 'about']);
Route::get('/login', [\App\Http\Controllers\MainController::class, 'login'])->name('login');
Route::get('/signup', [\App\Http\Controllers\MainController::class, 'signup']);
Route::get('/profil', [\App\Http\Controllers\MainController::class, 'profil'])->name('profil');
Route::post('/login/check', [\App\Http\Controllers\MainController::class, 'loginCheck']);
Route::post('/signup/check', [\App\Http\Controllers\MainController::class, 'signupCheck']);
Route::get('/leave',[ \App\Http\Controllers\MainController::class, 'leave'])->name('leave');
Route::post('/dataset',[\App\Http\Controllers\MainController::class, 'dataset'])->name('dataset');


