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

# PAGINA INICIAL
Route::get('/', "WelcomeController@welcome")->name("welcome");

// SHOP ITEM
Route::get('/shop/{id}', "WelcomeController@shop_item")->name("welcome.shop_item");

// SELECT CATEGORY
Route::get('/category/{category}', "WelcomeController@products_category")->name("welcome.products_category");

// SEARCH RESULTS
Route::post('/search', "WelcomeController@search")->name("welcome.search");

# CLIENT #
Route::get('/client', "ClientController@home_client")->name("client.home_client");

// FORM TO UPDATE CLIENT
Route::get('/changePassword','ClientController@showChangePasswordForm')->name('client.showChangePasswordForm');
Route::post('/changePassword','ClientController@changePassword')->name('changePassword');
Route::post('/changeDataUser','ClientController@changeDataUser')->name('changeDataUser');

# ADMIN # -> So o admin consegue aceder a estas paginas
Route::get('/index', "PagesController@index")->name("pages.index")->middleware('is_admin');
Route::get('/about', "PagesController@about")->name("pages.about")->middleware('is_admin');

// SELECT
Route::get('/products','ProductsController@index')->name('products.index')->middleware('is_admin');
// FORM TO INSERT
Route::get('/products/create','ProductsController@create')->name('products.create')->middleware('is_admin');
// INSERT
Route::post('/products','ProductsController@store')->name('products.store')->middleware('is_admin'); // making a post request
// SELECT BY ID
Route::get('/products/{id}','ProductsController@show')->name('products.show')->middleware('is_admin');
// FORM TO UPDATE
Route::get('/products/{id}/edit','ProductsController@edit')->name('products.edit')->middleware('is_admin');
// UPDATE BY ID
Route::put('/products/{id}','ProductsController@update')->name('products.update')->middleware('is_admin'); // making a put request
// DELETE BY ID
Route::delete('/products/{id}','ProductsController@destroy')->name('products.destroy')->middleware('is_admin'); // making a delete request


