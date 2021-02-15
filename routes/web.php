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

/*Route::get('/', function () {
    return view('welcome');
});*/

use App\Http\Controllers\MenuSGController;
use App\Http\Controllers\ThematicSGController;
use App\Http\Controllers\RankingSGController;

Route::get('/', [MenuSGController::class, 'index'])->name('menu');

Route::resource('/thematic', ThematicSGController::class);
Route::get('ranking', [RankingSGController::class, 'index']);

//----------Tematicas_slide----------------//
//Route::get('/tematicasSG', 'TematicasSGController@index')->name('TematicasST.index');;
//Route::get('/tematicas/create', 'Tematicas_STController@create')->name('TematicasST.create');
//Route::post('/tematicas/store', 'Tematicas_STController@store')->name('TematicasST.store');
//Route::get('/tematicas/{id}', 'Tematicas_STController@show')->name('TematicasST.show');
//Route::get('/tematicas/{id}/edit', 'Tematicas_STController@edit')->name('TematicasST.edit');
//Route::put('/tematicas/{id}', 'Tematicas_STController@update')->name('TematicasST.update');
//Route::delete('/tematicas/{id}/delete', 'Tematicas_STController@destroy')->name('TematicasST.destroy');
