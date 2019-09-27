<?php

use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::resource('users', 'Users\UserController');

Route::resource('roles', 'roles\RoleController');
Route::resource('permissions', 'permissions\PermissionController');


Route::resource('products', 'products\ProductController');

Route::resource('categories', 'categories\CategoryController');


Route::resource('sellers', 'sellers\SellerController');

Route::resource('buyers', 'buyers\BuyerController');


Route::resource('transactions', 'transactions\TransactionController');
