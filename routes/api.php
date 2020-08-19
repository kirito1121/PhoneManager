<?php

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

Route::get("twilio/sms", "TwilioSMSController@index");
Route::post("twilio/sms/send", "TwilioSMSController@post");
Route::get("twilio/sms/get", "TwilioSMSController@get");

Route::get("twilio/voice", "TwilioVoiceController@index");
Route::post("twilio/voice/call", "TwilioVoiceController@call");
Route::post("twilio/voice/receive", "TwilioVoiceController@receive");
Route::get("twilio/voice/get", "TwilioVoiceController@get");
Route::get("twilio/voice/recording", "TwilioVoiceController@recordingVoice");
Route::get("twilio/voice/fetchRecording", "TwilioVoiceController@fetchRecording");
