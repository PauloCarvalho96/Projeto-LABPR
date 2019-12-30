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

//Route::get('/', "PagesController@index");

Route::get('/index', "PagesController@index")->name("pages.index");
Route::get('/about', "PagesController@about")->name("pages.about");

// SELECT
Route::get('/employees','EmployeesController@index')->name('employees.index');
// FORM TO INSERT
Route::get('/employees/create','EmployeesController@create')->name('employees.create');
// INSERT
Route::post('/employees','EmployeesController@store')->name('employees.store'); // making a post request
// SELECT BY ID
Route::get('/employees/{id}','EmployeesController@show')->name('employees.show');
// FORM TO UPDATE
Route::get('/employees/{id}/edit','EmployeesController@edit')->name('employees.edit');
// UPDATE BY ID
Route::put('/employees/{id}','EmployeesController@update')->name('employees.update'); // making a put request
// DELETE BY ID
Route::delete('/employees/{id}','EmployeesController@destroy')->name('employees.destroy'); // making a delete request


//Route::resource('/employees','EmployeesController');


