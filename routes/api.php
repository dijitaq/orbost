<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['api' => 'ApiSendMailController'], function() {

	// Appraisal form
	Route::get('/send/mail/appraisal', 'ApiSendMailController@send_appraisal')->name('api.send.appraisal');
	Route::post('/send/mail/appraisal', 'ApiSendMailController@send_appraisal')->name('api.send.appraisal');

	// Contact form
	Route::get('/send/mail/contact', 'ApiSendMailController@send_contact')->name('api.send.contact');
	Route::post('/send/mail/contact', 'ApiSendMailController@send_contact')->name('api.send.contact');	
});