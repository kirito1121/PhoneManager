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

Route::get("twilio/sms","TwilioSMSController@index");
Route::post("twilio/sms/send","TwilioSMSController@post");
Route::get("twilio/sms/get","TwilioSMSController@get");

Route::get("twilio/voice","TwilioVoiceController@index");
Route::post("twilio/voice/call","TwilioVoiceController@post");
// Route::get("twilio/voice/answer","TwilioVoiceController@get");
