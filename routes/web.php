<?php

use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

// Route Gest Redirect to dashboard when user is
Route::group(['middleware' => 'guest'], function () {

    Route::get('/', function () {
        return view('auth.login');
    });

});




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],

    function () {


        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::resource('grades', GradeController::class);

        Route::resource('classrooms', ClassroomController::class);

    }
);



