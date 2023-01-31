<?php
use App\Http\Controllers\Test;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('login', 'LoginController@index')->name('login');
Route::post('login', 'LoginController@login')->name('login_post');
Route::get('logout', 'LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'HomeController@index');

});

//Route::get('/test',[TestController::class, 'index']);