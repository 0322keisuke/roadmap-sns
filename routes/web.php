<?php

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

Auth::routes();
Route::get('/login/guest','Auth\LoginController@authenticate');
Route::get('/','RoadmapController@index');

Route::get('/tutorials', 'TutorialController@index')->name('tutorials.index');

Route::prefix('roadmaps')->name('roadmaps.')->group(function(){
  {
    Route::put('/{roadmap}/like','RoadmapController@like')->name('like')->middleware('auth');
    Route::delete('/{roadmap}/like','RoadmapController@unlike')->name('unlike')->middleware('auth');
  }
});