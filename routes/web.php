<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HourController;

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
    return view('home');
});

Route::view('about', 'about');
Route::view('contact', 'contact');
//
//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

//auth route for all
Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/addNewPerson', [RegisterController::class, 'index'])->name('register');
    Route::post('/addNewPerson', [RegisterController::class, 'store']);

    Route::get('/allMyHours', [HourController::class,'index'])->name('Myhours');

    Route::get('/addNewHour',[HourController::class,'create'])->name('add');
    Route::post('/createNewHour', [HourController::class,'store']);

    Route::get('/hour-update/{id}', [HourController::class, 'edit']);
    Route::post('/day-updated', [HourController::class, 'update'])->name('day.update');

    Route::get('/staffHour', [HourController::class, 'staffHour'])->name('staffHour');

    Route::get('/hours-detail/{id}', [HourController::class, 'show'])->name('hours-detail');
    Route::get('/hours-update/{id}', [HourController::class, 'edit']);
    Route::get('/hours-delete/{id}', [HourController::class, 'destroy']);

});
