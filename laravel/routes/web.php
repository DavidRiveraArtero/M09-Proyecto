<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ModelsController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\CategoriesController;


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

Route::get('/', function (Request $request) {
    $message = 'Loading welcome page';

    $request->session()->flash('info', $message);
    return view('welcome');
});

Route::get('/home2', function(){
    return view('Home');
});

Route::get('/inicio', function(){
    return view('inicio');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



Route::get('mail/test',[MailController::class, 'test'])->name('enviarcorreo')->middleware(['auth']);

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ROUTE FILE
Route::resource('files',FileController::class)->middleware(['auth', 'role:3']);

Route::resource('models',ModelsController::class);
Route::resource('assets',AssetsController::class);
Route::resource('categories',CategoriesController::class);


