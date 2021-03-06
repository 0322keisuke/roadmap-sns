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
Route::post('/roadmaps/copy', 'RoadmapController@copy')->name('roadmaps.copy')->middleware('auth');

Route::get('/tutorials', 'TutorialController@index')->name('tutorials.index')->middleware('auth');
Route::post('/tutorials/store', 'TutorialController@store')->middleware('auth')->name('tutorials.store');
Route::delete('/tutorials/{tutorial}/destroy', 'TutorialController@destroy')->middleware('auth')->name('tutorials.destroy');
Route::match(['put', 'patch'], '/tutorials/{tutorial}/status', 'TutorialController@status')->middleware('auth')->name('tutorials.status');

Route::post('/tasks/store', 'TaskController@store')->name('tasks.store')->middleware('auth');
Route::match(['put', 'patch'], '/tasks/update', 'TaskController@update')->name('tasks.update')->middleware('auth');
Route::delete('/tasks/{task}/destroy', 'TaskController@destroy')->name('tasks.destroy')->middleware('auth');


Route::prefix('roadmaps')->name('roadmaps.')->group(function () { {
    Route::put('/{roadmap}/like', 'RoadmapController@like')->name('like')->middleware('auth');
    Route::delete('/{roadmap}/like', 'RoadmapController@unlike')->name('unlike')->middleware('auth');
  }
});
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

Route::prefix('users')->name('users.')->group(function () {
  Route::get('/{name}', 'UserController@show')->name('show');
  Route::get('/{name}/likes', 'UserController@likes')->name('likes');
  Route::get('/{name}/followings', 'UserController@followings')->name('followings');
  Route::get('/{name}/followers', 'UserController@followers')->name('followers');
  Route::middleware('auth')->group(function () {
    Route::put('/{name}/follow', 'UserController@follow')->name('follow');
    Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
  });
});
