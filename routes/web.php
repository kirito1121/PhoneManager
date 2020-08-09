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

Route::get('/', function () {
    return view('sms');
});

Route::get('/sms', function () {
    return view('sms');
});
Route::get('/voice', function () {
    return view('voice');
});
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/sms', 'HomeController@index')->name('home');
// Route::get('/voice', 'HomeController@index');
Route::get('/getVoice', function () {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.twilio.com/2010-04-01/Accounts/ACd40df911a63cea4375b1a8166a443a5e/Recordings/RE1bad8efadac082175afb08534adbc613.mp3');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    curl_setopt($ch, CURLOPT_USERPWD, 'ACd40df911a63cea4375b1a8166a443a5e' . ':' . '27bceb352670e9be406f02b6a8b8dacd');

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

});
