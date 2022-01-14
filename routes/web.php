<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

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

Route::get('/', [ MainController::class, 'home' ])->name('home');

Route::name('user.')->group(function(){
    Route::get('/users', [ UserController::class, 'users' ])->middleware( middleware: 'auth')->name('users');
    // Route::view('/users', 'users')->middleware( middleware: 'auth')->name('users');

    Route::get('/login', function(){
        if(Auth::check()){
            return redirect(route('user.users'));
        }
        return view( view: 'login');
    })->name('login');

    Route::post('/login', [ LoginController::class, 'login' ]);

    Route::get('/logout', function(){
        Auth::logout();
        return redirect(route('home'));
    })->name('logout');

    Route::get('/registration', function(){
        if(Auth::check()){
            return redirect(route('user.users'));
        }
        return view( view: 'registration');
    })->name('registration');

    Route::post('/registration', [ RegistrationController::class, 'save' ]);
});