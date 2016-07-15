<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::auth();

Route::get('/home', function () {
	return redirect('/dashboard');
});

Route::get('/test', function () {
	return view('blank', array('page' => 'dashboard'));
});

// create student
Route::post('/student', 'StudentController@create');

// get student
Route::get('/student', 'StudentController@getAll');
Route::get('/student/{id}', 'StudentController@getStudent');

// update student
Route::put('/student/{id}', 'StudentController@updateStudent');

// delete student
Route::delete('/student', 'StudentController@deleteStudent');

// get saving
Route::get('/saving', 'SavingController@getAllSaving');
Route::get('/saving/{id}', 'SavingController@getSaving');

// create transactions
Route::post('/transaction/add', 'TransactionController@addTransaction');

// get transactions
Route::get('/transaction', 'TransactionController@getAllTransaction');
Route::get('/transaction/deposit', 'TransactionController@getDeposit');
Route::get('/transaction/withdrawal', 'TransactionController@getWithDrawal');
Route::get('/transaction/add', 'TransactionController@viewAdd');

// setting
Route::get('/setting', 'UserController@viewSetting');

// ganti password
Route::post('/setting', 'UserController@updatePassword');

// dashboard
Route::get('/dashboard', 'DashboardController@index');

Route::get('/api/student', 'StudentController@getApi');
Route::get('/api/student/{id}', 'StudentController@getApiId');