<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\IdenticonController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
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
})->name('home');

Route::get('/app', [AppController::class, 'showApp'])->name('app');
Route::get('/preview', [AppController::class, 'preview'])->name('preview');

Route::get('/login', [AuthenticationController::class, 'showLoginPage'])->name('login-form');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::get('/register', [RegistrationController::class, 'showRegistrationPage'])->name('registration-form');
Route::post('/register', [RegistrationController::class, 'register'])->name('register');

Route::get('/identicons', [IdenticonController::class, 'showIdenticons'])->name('list-identicons');
Route::get('/identicons/{identicon_id}', [IdenticonController::class, 'showIdenticon'])->name('show-identicon');
Route::post('/identicons', [IdenticonController::class, 'saveIdenticon'])->name('save-identicon');
Route::get('/identicons/{identicon_id}/delete', [IdenticonController::class, 'deleteIdenticon'])->name('delete-identicon');

Route::get('/me', [UserController::class, 'showProfile'])->name('profile');
Route::patch('/me', [UserController::class, 'updateProfile'])->name('update-profile');
Route::post('/me/upgrade', [UserController::class, 'upgrade'])->name('upgrade-profile');

Route::get('/upgrades', [UserController::class, 'upgrades'])->name('upgrades');
Route::get('/users/{user_id}/update/confirm', [UserController::class, 'confirm'])->name('confirm-upgrade');
Route::get('/users/{user_id}/update/reject', [UserController::class, 'reject'])->name('reject-upgrade');
