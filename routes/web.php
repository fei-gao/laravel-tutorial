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
use App\Services\Twitter;
use App\Repositories\UserRepository;
use App\Notifications\SubscriptionRenewalFailed;

Route::get('/', function (Twitter $twitter) {
    // dd($twitter);
//    return view('welcome');
    $user = App\User::first();
    $user->notify(new SubscriptionRenewalFailed);
    return 'done';
});

Route::resource('projects', 'ProjectsController');
// is equivalent to the below
// Route::get('/projects', 'ProjectsController@index');
// Route::post('/projects', 'ProjectsController@store');
// Route::get('/projects/{project}', 'ProjectsController@show');
// Route::get('/projects/create', 'ProjectsController@create');
// Route::get('/projects/{project}/edit', 'ProjectsController@edit');
// Route::patch('/projects/{project}', 'ProjectsController@update');
// Route::delete('/projects/{project}', 'ProjectsController@destroy');

Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
Route::post('/completed-tasks/{task}', 'CompletedTasksController@store');
Route::delete('/completed-tasks/{task}', 'CompletedTasksController@destroy');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
