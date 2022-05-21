<?php

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
    return view('Pages.home');
});

//Auth
Route::get('/login','AuthController@index')->name('login');
Route::post('/login','AuthController@login')->name('login');;

Route::get('/logout','AuthController@logout')->name('logout');
Route::get('/register', 'RegisterController@index')->name('register');
Route::post('/register', 'RegisterController@register')->name('register');
Route::get('/tentang_aplikasi', 'TentangController@index')->name('tentang');

Route::group(['middleware' => 'CekloginMiddleware'], function(){

    Route::get('/bencana','BencanaController@index')->name('bencana');
    // Route Data For Linmas
    Route::get('/datalinmas','DatalinmasController@index')->name('dataLinmas');
    Route::post('/datalinmas/store','DatalinmasController@store');
    Route::get('/datalinmas/delete/{objectid}','DatalinmasController@deleteId');
    Route::post('/datalinmas/getdata','DatalinmasController@getSingleData');
    Route::post('/datalinmas/update','DatalinmasController@updateData');
    
    //Route Data linmas Tibum
    Route::get('/linmas_tibum','LinmastibumController@index');
    Route::post('/linmas_tibum/store','LinmastibumController@store');
    Route::get('/linmas_tibum/delete/{objectid}','LinmastibumController@deleteId');
    Route::post('/linmas_tibum/getdata','LinmastibumController@getSingleData');
    Route::post('/linmas_tibum/update','LinmastibumController@updateData');
    
    //Route Bencana dan Kebakaran
    Route::get('/bencana_kebakaran','BencanaController@index');
    Route::post('/bencana_kebakaran/store','BencanaController@store');
    Route::get('/bencana_kebakaran/delete/{objectid}','BencanaController@deleteId');
    Route::post('/bencana_kebakaran/getdata','BencanaController@getSingleData');
    Route::post('/bencana_kebakaran/update','BencanaController@updateData');
    
    //Route Pengamanan
    Route::get('/pengamanan','LappengamananController@index');
    Route::post('/pengamanan/store','LappengamananController@store');
    Route::get('/pengamanan/delete/{objectid}','LappengamananController@deleteId');
    Route::post('/pengamanan/getdata','LappengamananController@getSingleData');
    Route::post('/pengamanan/update','LappengamananController@updateData');
    
    //Route Kegiatan Lainnya
    Route::get('/kegiatan_lainnya','KegiatanlainnyaController@index');
    Route::post('/kegiatan_lainnya/store','KegiatanlainnyaController@store');
    Route::get('/kegiatan_lainnya/delete/{objectid}','KegiatanlainnyaController@deleteId');
    Route::post('/kegiatan_lainnya/getdata','KegiatanlainnyaController@getSingleData');
    Route::post('/kegiatan_lainnya/update','KegiatanlainnyaController@updateData');
});

//Route Penegakan Perda
Route::get('/penegakan_perda','PerdaController@index');

//Route Penegakan Perka
Route::get('/penegakan_perka','PerkaController@index');