<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramController;

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

Route::get('/', [TelegramController::class, 'index']);

Route::get('/chat', [TelegramController::class, 'chat']);
Route::post('/send-chat', [TelegramController::class, 'sendChat']);

Route::get('/gambar', [TelegramController::class, 'gambar']);
Route::post('/send-gambar', [TelegramController::class, 'sendGambar']);

Route::get('/dokumen', [TelegramController::class, 'dokumen']);
Route::post('/send-dokumen', [TelegramController::class, 'sendDokumen']);
