<?php

use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Sections\SectionController;
use App\Livewire\AddParent;
use App\Livewire\Counter;
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
            Route::post('Filter_Classes', [ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');
            Route::post('delete_all', [GradeController::class, 'delete_all'])->name('delete_all');
            Route::resource('sections', SectionController::class);
            Route::get("classes/{id}", [SectionController::class, 'getClasses'])->name('getClasses');
            // Route::get('/add_parent', function () {
            //       return view('livewire.show-form');
            // });
            // Route::view('add_parent', 'livewire.show_Form');
            Route::get('add_parent', AddParent::class)->name('add_parent');
            // Route::get('counter', Counter::class);
      }
);

Auth::routes();
