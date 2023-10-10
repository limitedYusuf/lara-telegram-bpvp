<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\TelegramTrait;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    use TelegramTrait;

    public function index()
    {
        $response = $this->getMe();
        return dd($response);
    }

    public function chat()
    {
        return view('chat');
    }

    public function sendChat(Request $request)
    {
        $message = $request->input('message');
        $chatId = env('CHANNEL_ID');
        $this->sendMessage($chatId, $message);

        return "Text sudah dikirim";
    }

    public function gambar()
    {
        return view('gambar');
    }

    public function sendGambar(Request $request)
    {
        $caption = $request->input('caption');
        $photo = $request->file('photo');

        if ($photo->isValid()) {
            $chatId = env('CHANNEL_ID');
            $this->sendPhoto($chatId, $photo, $caption);

            return "Foto berhasil dikirim ke channel Telegram dengan caption.";
        } else {
            return "Gagal mengunggah foto.";
        }
    }

    public function dokumen()
    {
        return view('dokumen');
    }

    public function sendDokumen(Request $request)
    {
        $caption = $request->input('caption');
        $file = $request->file('file');

        if ($file->isValid()) {
            $chatId = env('CHANNEL_ID');
            $this->sendDocument($chatId, $file, $caption);

            return "File berhasil dikirim ke channel Telegram dengan caption.";
        } else {
            return "Gagal mengunggah file.";
        }
    }

    public function setWebhook()
    {
        $response = Telegram::setWebhook(['url' => env('TELE_WEB')]);
        dd($response);
    }

    public function commandHandlerWebHook()
    {
        $updates = Telegram::commandsHandler(true);
        $chat_id = $updates->getChat()->getId();
        $username = $updates->getChat()->getFirstName();

        if (strtolower($updates->getMessage()->getText() === 'siapakah yusuf?')) return Telegram::sendMessage([
            'chat_id' => $chat_id,
            'text' => 'Yusuf merupakan orang tampan dan sangat ramah kepada orang lain, suka menolong & membantu. Beliau merupakan haters wibu garis keras'
        ]);
    }
}
