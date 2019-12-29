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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('approval', 'HomeController@approval')->name('approval');

    Route::middleware(['approved'])->group(function () {
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    });

    Route::middleware(['admin'])->group(function () {
        Route::get('/users', 'UserController@index')->name('admin.users.index');
        Route::get('/users/{user_id}/approve', 'UserController@approve')->name('admin.users.approve');
    });
    
});


Route::resources([
    'staff' => 'StaffController',
    'dependants' => 'DependantsController',
    'servicehistories' => 'ServiceHistoriesController',
    'designations' => 'DesignationController',
    'qualifications' => 'QualificationsController',
    'exams' => 'ExamsController',
    'services' => 'ServiceController'
]);

Route::get('change-password', 'ChangePasswordController@index')->name('change.passwordview');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

//Route::get('/live_search', 'LiveSearch@index');
Route::get('', 'LiveSearch@action')->name('live_search.action');