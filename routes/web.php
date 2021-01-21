<?php

use App\models\Stock_Enter;
use Illuminate\Support\Facades\Route;


Route::post('home', 'StockEnterController@store')->name('home');

Route::get('home', function () {
	return view('home');
});
Route::get('/', function () {
	$stock = new Stock_Enter();
    return view('home', compact('stock'));
});


Route::prefix('admin')->group(function () {
  	Route::name('gestion.')->group(function () {
		Route::post('posts', 'RoleController@store')->name('posts');
	
 	});

 	Route::name('planification.')->group(function () {
	   	Route::get('department_chief/delete', 'PlanificationController@deleteDepartment_chief')->name('department_chief/delete');
	   	Route::get('department_chief', 'PlanificationController@department_chief')->name('department_chief');

 	});

	Route::resource('administrators', 'AdminController');
	Route::resource('teachers', 'TeachersController');
	Route::resource('parents', 'ParentsController');
	Route::resource('books', 'BooksController');
	Route::resource('periods', 'PeriodController');
});
