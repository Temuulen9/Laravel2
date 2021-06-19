<?php

use Illuminate\Support\Facades\Route;
use App\Models\Branch;
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
    $branchs = Branch::all();
    return view('welcome')->with('branchs', $branchs);
});

Auth::routes();

Route::get('/profile/{user}', 'App\Http\Controllers\Admin\UsersController@show')->name('profile.show');
Route::get('/profile/edit/{user}', 'App\Http\Controllers\Admin\UsersController@edit')->name('profile.edit');
Route::get('/profile/changepassword/{user}', 'App\Http\Controllers\Admin\UsersController@changePassword')->name('profile.changePassword');
Route::put('/profile/change/{user}', 'App\Http\Controllers\Admin\UsersController@change')->name('profile.change');
Route::put('/profile/update/{user}', 'App\Http\Controllers\Admin\UsersController@updateProfile')->name('profile.update');
Route::get('/durem', 'App\Http\Controllers\DuremController@index')->name('durem');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('App\Http\Controllers\Quiz')->prefix('test')->name('test.')->group(function (){
    
    Route::get('/exam/check', [App\Http\Controllers\Quiz\TestController::class, 'check'])->name('exam.check');
    Route::get('/exam/result', [App\Http\Controllers\Quiz\TestController::class, 'result'])->name('exam.result');
    Route::get('/exam', [App\Http\Controllers\Quiz\TestController::class, 'index'])->name('exam.index');
    Route::get('/sub', [App\Http\Controllers\Quiz\TestController::class, 'indexsub'])->name('sub.index');
    Route::get('/sub/check', [App\Http\Controllers\Quiz\TestController::class, 'check'])->name('sub.check');
    Route::get('/sub/show/{sub}', [App\Http\Controllers\Quiz\TestController::class, 'showsub'])->name('sub.show');
});

Route::get('/admins', 'App\Http\Controllers\Admin\UsersController@admin')->name('admins')->middleware('can:owner');
Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware('can:manage-user')->group(function (){ 
    Route::resource('/branches', 'BranchesController');
    Route::resource('/users', 'UsersController', ['except' => 'show']);
    Route::resource('/questions', 'QuestionController', ['except' => 'show']);
});

