<?php

use Illuminate\Support\Facades\Route;
use Telegram\Bot\FileUpload\InputFile;
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
    $response = Telegram::bot('mybot')->getMe();
    return dd($response);
});

Route::get('/chat', function () {
    return view('chat');
});

Route::post('/send-chat', function () {
    $response = Telegram::sendMessage([
        'chat_id' => env('CHANNEL_ID'),
        'text' => request()->input('message'),
    ]);

    // dd($response->getMessageId());
    return "Text sudah dikirim";
});

Route::get('/file', function () {
    return view('file');
});

Route::post('/send-file', function () {
    $caption = request()->input('caption');
    $photo = request()->file('photo');

    if ($photo->isValid()) {
        $response = Telegram::sendPhoto([
            'chat_id' => env('CHANNEL_ID'),
            'photo' => InputFile::create($photo->getPathname(), $photo->getClientOriginalName()),
            'caption' => $caption,
        ]);

        return "Foto berhasil dikirim ke channel Telegram dengan caption.";
    } else {
        return "Gagal mengunggah foto.";
    }
});
