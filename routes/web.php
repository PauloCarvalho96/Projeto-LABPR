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

Route::get('/index', "PagesController@index")->name("pages.index");
Route::get('/about', "PagesController@about")->name("pages.about");

// SELECT
Route::get('/products','ProductsController@index')->name('products.index');
// FORM TO INSERT
Route::get('/products/create','ProductsController@create')->name('products.create');
// INSERT
Route::post('/products','ProductsController@store')->name('products.store'); // making a post request
// SELECT BY ID
Route::get('/products/{id}','ProductsController@show')->name('products.show');
// FORM TO UPDATE
Route::get('/products/{id}/edit','ProductsController@edit')->name('products.edit');
// UPDATE BY ID
Route::put('/products/{id}','ProductsController@update')->name('products.update'); // making a put request
// DELETE BY ID
Route::delete('/products/{id}','ProductsController@destroy')->name('products.destroy'); // making a delete request


