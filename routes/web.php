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



Route::middleware(['auth'])->group(function () {
    Route::get('/approval', 'HomeController@approval')->name('approval');
    Route::get('/denial', 'HomeController@denial')->name('denial');
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    Route::middleware(['approved'])->group(function () {
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    });
    
    Route::middleware(['denied'])->group(function () {
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    });
    
    Route::middleware(['admin'])->group(function () {
        Route::get('/users', 'UserController@index')->name('admin.users.index');
        Route::get('/users/{user_id}/approve', 'UserController@approve')->name('admin.users.approve');
        Route::get('/users/{user_id}/enable', 'UserController@enable')->name('admin.users.enable');
        Route::get('/users/{user_id}/revoke', 'UserController@revoke')->name('admin.users.revoke');
        Route::get('/users/{user_id}/usertype', 'UserController@usertype')->name('admin.users.usertype');
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
Route::get('/livesearch', 'LiveSearch@action')->name('live_search.action');

Route::get('reports', 'ReportController@index')->name('reports.index');

Route::get('profile', 'UserController@profile')->name('users.profile');

Route::get('export', 'ReportController@export');
Route::get('export_dep', 'ReportController@export_dep');

Route::get('about', 'HomeController@about')->name('about');