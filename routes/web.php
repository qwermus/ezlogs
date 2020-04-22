<?php

use Illuminate\Support\Facades\Route;

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

// Redirect for testing route. In production it will be 404 here
Route::get('/', function () {
    return redirect(route('test.index'));
});

// Route for testing controller
Route::get('test', 'TestingController@index')->name('test.index');
Route::get('test/search', 'TestingController@search')->name('test.search');
