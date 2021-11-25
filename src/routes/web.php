<?php

use Illuminate\Support\Facades\{DB,Route};

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
    return view('welcome');
});

Route::get('/test', function(){
    // echo "work";
    $res = DB::table('users')->get();
    return response()->json($res);
});

Route::get('/sendMail', function(){
    // echo "sendmail";
    $recipient_email = 'm3gaplazma@gmail.com';
    // $response = \Mail::to($recipient_email)->send(new \App\Mail\ResetPasswordMail('https://youtube.com'));

    $data = [
        'reset_link'=>'https://youtube.com',
    ];
    dispatch( new \App\Jobs\SendMailJob('resetPassword', $recipient_email,  $data) );

    return response()->json('sending mail');
});
