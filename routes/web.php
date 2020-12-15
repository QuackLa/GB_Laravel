<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Controller;

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

Route::get('/', function() {
    return view('main');
})->name('main');


Route::get('/CatNews', [NewsController::class, 'CatNews']);
Route::get('/NewsByCat', [NewsController::class, 'NewsByCat']);
Route::get('/OneNews/{id?}', [NewsController::class, 'OneNews']);
Route::get('/welcome', [Controller::class, 'welcome']);