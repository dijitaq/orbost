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

Route::get('/', 'StaticController@index')->name('home');
Route::get('/sell', 'StaticController@sell')->name('sell');
Route::get('/about', 'StaticController@about')->name('about');
Route::get('/contact', 'StaticController@contact')->name('contact');

Route::get('/listing/{id}/{slug}', 'ListingController@listing');
Route::get('/listings/all', 'ListingController@all');

Route::get('/listings/update', 'ListingController@update');
Route::get('/listings/doupdate', 'ListingController@doupdate')->name('update');
Route::get('/listings/getactive', 'ListingController@getactive')->name('get-active');
Route::get('/listings/getsold', 'ListingController@getsold')->name('get-sold');
Route::get('/listings/update-complete', 'ListingController@update_complete')->name('update-complete');

Route::get('/listings/view/{id}', 'ListingController@view');
Route::get('/listings/{type}', 'ListingController@listings');

Route::get('/make-it-a-tree-change', 'BlogController@posts')->name('make-it-a-tree-change');
Route::get('/article/{slug}', 'BlogController@article');