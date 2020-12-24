<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\NewsController;


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


/** Главная страница */
Route::get('/', function() 
    { 
        return view('welcome'); 
    })
    ->name('main');


/** Блок новостей */
Route::get('/CatNews', [NewsController::class, 'CatNews'])
    ->name('CatNews');

Route::get('/NewsByCat', [NewsController::class, 'NewsByCat'])
    ->name('NewsByCat');

Route::get('/OneNews/{id?}', [NewsController::class, 'OneNews'])
    ->name('OneNews');

/** Вкладка 'Войти' */
Route::get('/EnterUser/{alarm?}', [UsersController::class, 'EnterUser'])
    ->name('EnterUser');

/** Переход к регистрации */
Route::get('/WannaReg/{alarm?}', [UsersController::class, 'WannaReg'])
    ->name('WannaReg');

/** Отправляем данные регистрации из формы в контроллер */
Route::post('/RegUser', [UsersController::class, 'RegUser'])
    ->name('RegUser');

/** Проверяем данные при входе. Так же их отправляем формой */
Route::post('/AuthUser', [UsersController::class, 'AuthUser'])
    ->name('AuthUser');

/** Переход в личный кабинет */
Route::get('/LC', [UsersController::class, 'LC'])
    ->name('LC');

/** Выход пользователя */
Route::get('/Logout', [UsersController::class, 'Logout'])
    ->name('Logout');
