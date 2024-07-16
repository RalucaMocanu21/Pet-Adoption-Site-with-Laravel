<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnimaleController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\StatisticiPostariController;
use App\Http\Controllers\AdoptieController;
use App\Http\Controllers\StatisticiCereriController;


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


Route::middleware(['auth', 'admin'])->group(function () {
  Route::get('/animale/create', [AnimaleController::class, 'create'])->name('animale.create');
  Route::post('/animale/store', [AnimaleController::class, 'store'])->name('animale.store');
  Route::get('/animale/{animal_id}/edit', [AnimaleController::class, 'edit'])->name('animale.edit');
  Route::put('/animale/{animal_id}', [AnimaleController::class, 'update'])->name('animale.update');
  Route::delete('/animale/{animal_id}', [AnimaleController::class, 'destroy'])->name('animale.destroy');
  Route::get('/statistici-postari', [StatisticiPostariController::class, 'index'])->name('statistici.postari');
  Route::get('/statistici-cereri', [StatisticiCereriController::class, 'index'])->name('statistici.cereri');
});


Route::middleware('auth')->group(function () {
  Route::get('/animale/filter', [AnimaleController::class, 'filter'])->name('animale.filter');
  Route::get('/animale/{animal_id}', [AnimaleController::class, 'show'])->name('animale.show');
  Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index');
  Route::post('/favorite/adauga/{animal_id}', [FavoriteController::class, 'adaugaLaFavorite'])->name('favorite.adaugaLaFavorite');
  Route::delete('/favorite/sterge/{animal_id}', [FavoriteController::class, 'stergeDinFavorite'])->name('favorite.stergeDinFavorite');
  Route::get('/animale/{animal_id}/edit', [AnimaleController::class, 'edit'])->name('animale.edit');
  Route::put('/animale/{animal_id}', [AnimaleController::class, 'update'])->name('animale.update');
  Route::delete('/animale/{animal_id}', [AnimaleController::class, 'destroy'])->name('animale.destroy');
  Route::get('/animale/create', [AnimaleController::class, 'create'])->name('animale.create');
  Route::post('/animale/store', [AnimaleController::class, 'store'])->name('animale.store');
  Route::get('/adoptie/create/{animal_id}', [AdoptieController::class, 'create'])->name('adoptie.create');
  Route::post('/adoptie/store/{animal_id}', [AdoptieController::class, 'store'])->name('adoptie.store');
  Route::get('/cereri', [AdoptieController::class, 'index'])->name('cereri.index');
  Route::post('/cereri/{cerere_id}/accepta', [AdoptieController::class, 'accepta'])->name('cereri.accepta');
  Route::delete('/cereri/{cerere_id}/anuleaza', [AdoptieController::class, 'anuleaza'])->name('cereri.anuleaza');

});


Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/password/reset', [AuthController::class, 'showResetPasswordForm'])->name('password.request');
Route::post('/password/reset', [AuthController::class, 'reset'])->name('password.update');


Route::get('/contact', [WelcomeController::class, 'showContactForm'])->name('contact');
Route::post('/contact', [WelcomeController::class, 'sendContactForm'])->name('send');


Route::get('/animale/filter', [AnimaleController::class, 'filter'])->name('animale.filter');
Route::get('/animale/{animal_id}', [AnimaleController::class, 'show'])->name('animale.show');
Route::get('/animale', [AnimaleController::class, 'index'])->name('animale.index');
Route::get('/', [WelcomeController::class, 'index']);
Route::get('about', [WelcomeController::class, 'about']);
Route::get('contactp', [WelcomeController::class, 'contactp']);
Route::get('despre', [WelcomeController::class, 'despre']);
Route::get('despresir', [WelcomeController::class, 'despresir']);