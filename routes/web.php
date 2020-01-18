<?php
/*
|--------------------------------------------------------------------------
|
| Universidade Fernando Pessoa
| Laboratório de Programação
| 13/01/2020
| Paulo Carvalho nº 37113
| Pedro Pinheiro nº 36763
|
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

##############################################################

# PAGINA INICIAL # -> TODOS TEM ACESSO A ESTAS PÁGINAS
Route::get('/', "WelcomeController@welcome")->name("welcome");
// SHOP ITEM
Route::get('/shop/{id}', "WelcomeController@shop_item")->name("welcome.shop_item");
// SELECT CATEGORY
Route::get('/category/{category}', "WelcomeController@products_category")->name("welcome.products_category");
// SEARCH RESULTS
Route::get('/search', "WelcomeController@search")->name("welcome.search");
//sort by price
Route::get('/price_ascending', "WelcomeController@sortByPriceAscending")->name("welcome.sort_by_price_ascending");
Route::get('/price_descending', "WelcomeController@sortByPriceDescending")->name("welcome.sort_by_price_descending");
Route::get('/price_ascending/{category}', "WelcomeController@sortByPriceAscendingCategory")->name("welcome.sort_by_price_ascending_category");
Route::get('/price_descending/{category}', "WelcomeController@sortByPriceDescendingCategory")->name("welcome.sort_by_price_descending_category");

##############################################################

# Só o cliente tem acesso a estas páginas #
Route::get('/client', "ClientController@getCart")->name("client.home_client")->middleware('verified');

// orders client
Route::get('/show_orders', "ClientController@show_orders")->name("client.show_orders")->middleware('verified');

// FORM TO UPDATE CLIENT
Route::get('/changePassword','ClientController@showChangePasswordForm')->name('client.showChangePasswordForm')->middleware('verified');
Route::post('/changePassword','ClientController@changePassword')->name('changePassword')->middleware('verified');
Route::post('/changeDataUser','ClientController@changeDataUser')->name('changeDataUser')->middleware('verified');
Route::post('/deleteUser','ClientController@deleteUser')->name('deleteUser')->middleware('verified');

# CARRINHO DE COMPRAS
// ADICIONAR AO CARRINHO
Route::get('/add_to_cart/{id}','ClientController@addCart')->name('product.addToCart')->middleware('verified');
// VER CARRINHO DE COMPRAS
Route::get('/shopping_cart','ClientController@getCart')->name('product.shoppingCart')->middleware('verified');
// ELIMINAR DO CARRINHO
Route::get('/remove_from_cart/{id}','ClientController@deleteCart')->name('product.removeFromCart')->middleware('verified');
Route::get('/lessItem/{id}','ClientController@lessItem')->name('product.lessItem')->middleware('verified');
// CARRINHO
Route::get('/Checkout','ClientController@getCheckout')->name('product.getCheckout')->middleware('verified');
// Checkout store
Route::post('/Checkout','ClientController@storeCheckout')->name('product.storeCheckout')->middleware('verified');

// UPDATE DO CARRINHO
Route::get('/update_from_cart/{id}','ClientController@updateCart')->name('product.updateFromCart')->middleware('verified');

#mail
Route::get('/sendmail','ClientController@sendmail')->name('order.mail')->middleware('verified');

#ver pdf
Route::get('show_pdf_order_client/{id}', 'ClientController@show_pdf_order')->name('client.orderPDF')->middleware('verified');

##############################################################

# ADMIN # -> So o admin consegue aceder a estas paginas
## Show users
Route::get('/showUsers', "ProductsController@showUsers")->name("products.showUsers")->middleware('is_admin');
## Delete Users
Route::get('/removeUser/{id}', "ProductsController@removeUser")->name("products.removeUser")->middleware('is_admin');
#orders
Route::get('/orders', "ProductsController@orders")->name("pages.orders")->middleware('is_admin');
# mostrar pdf encomenda
Route::get('show_pdf_order/{id}', 'ProductsController@show_pdf_order')->name('products.orderPDF')->middleware('is_admin');
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
// search products
Route::get('/search_products', "ProductsController@search_products")->name("products.search_products")->middleware('is_admin');
// search orders by email
Route::get('/search_orders', "ProductsController@search_orders")->name("products.search_orders")->middleware('is_admin');
// search orders by email
Route::get('/search_users', "ProductsController@search_users")->name("products.search_users")->middleware('is_admin');

##############################################################
