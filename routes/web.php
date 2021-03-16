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



//Route::get('/menuSG', [MenuSGController::class, 'index'])->name('ThematicSG.menu');

//Thematics//
Route::resource('/thematicSG', 'ThematicSGController@index')->name('ThematicSG.index');
Route::get('/thematicSG/create', 'ThematicSGController@create')->name('ThematicSG.create');
Route::get('/thematicSG/{id}/edit', 'ThematicSGController@edit')->name('ThematicSG.edit');
Route::post('/thematicSG/store', 'ThematicSGController@store')->name('ThematicSG.store');
Route::put('thematicSG/{id}', 'ThematicSGCotroller@update')->name('ThematicSG.update');
Route::delete('/thematic/{id}/delete', 'ThematicSGController@destroy')->name('ThematicSG.destroy');

//Ranking//
Route::get('/rankingSG', 'RankingSGController@index')->name('RankingSG.index');
Route::get('/rankingSG/create', 'RankingSGController@create')->name('RankingSG.create');
Route::post('/rankingSG/store', 'RankingSGController@store')->name('RankingSG.store');
Route::get('/rankingSG/{id}/edit', 'RankingSGController@edit')->name('RankingSG.edit');
Route::put('/rankingSG/{id}', 'RankingSGController@update')->name('RankingSG.update');
Route::delete('/rankingSG/{id}/delete', 'RankingSGController@destroy')->name('RankingSG.destroy');
