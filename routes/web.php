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

use App\Http\Controllers\RoadmapController;

Auth::routes();
Route::get('/login/guest', 'Auth\LoginController@authenticate');
Route::get('/', 'RoadmapController@index')->name('roadmaps.index');


Route::get('/roadmaps/create', 'RoadmapController@create')->name('roadmaps.create')->middleware('auth');
Route::post('/roadmaps/store', 'RoadmapController@store')->name('roadmaps.store')->middleware('auth');

Route::get('/roadmaps/{roadmap}', 'RoadmapController@show')->name('roadmaps.show');

Route::get('/tutorials', 'TutorialController@index')->name('tutorials.index')->middleware('auth');
Route::post('/tutorials/store', 'TutorialController@store')->middleware('auth');
Route::delete('/tutorials/{tutorial}/destroy', 'TutorialController@destroy')->middleware('auth');

Route::post('/tasks/store', 'TaskController@store')->middleware('auth');
Route::delete('/tasks/{task}/destroy', 'TaskController@destroy')->middleware('auth');


Route::prefix('roadmaps')->name('roadmaps.')->group(function () { {
    Route::put('/{roadmap}/like', 'RoadmapController@like')->name('like')->middleware('auth');
    Route::delete('/{roadmap}/like', 'RoadmapController@unlike')->name('unlike')->middleware('auth');
  }
});
