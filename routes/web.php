<?php

use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return dd($response = Telegram::bot('mybot')->getMe());
});

Route::get('/chat', function () {
    return view('chat');
});

Route::post('/send-chat', function () {
    $response = Telegram::sendMessage([
        'chat_id' => env('CHANNEL_ID'),
        'text' => 'Halo Nyoba kirim teks'
    ]);

    $messageId = $response->getMessageId();
    return dd($messageId);
});
