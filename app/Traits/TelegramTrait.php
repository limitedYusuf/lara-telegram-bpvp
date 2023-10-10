<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait TelegramTrait
{
   private function getApiUrl()
   {
      return 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN');
   }

   public function getMe()
   {
      $url = $this->getApiUrl() . '/getMe';

      $response = Http::get($url);

      return $response->json();
   }

   public function sendMessage($chatId, $text)
   {
      $url = $this->getApiUrl() . '/sendMessage';

      $response = Http::post($url, [
         'chat_id' => $chatId,
         'text' => $text,
      ]);

      return $response->json();
   }

   public function sendPhoto($chatId, $photo, $caption = '')
   {
      $url = $this->getApiUrl() . '/sendPhoto';

      $response = Http::attach(
         'photo',
         file_get_contents($photo),
         basename($photo)
      )->post($url, [
         'chat_id' => $chatId,
         'caption' => $caption,
      ]);

      return $response->json();
   }

   public function sendDocument($chatId, $document, $caption = '')
   {
      $url = $this->getApiUrl() . '/sendDocument';

      $originalName = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME);

      $response = Http::attach(
         'document',
         file_get_contents($document),
         $originalName . '.' . $document->getClientOriginalExtension()
      )->post($url, [
         'chat_id' => $chatId,
         'caption' => $caption,
      ]);

      return $response->json();
   }

   public function sendVideo($chatId, $video, $caption = '')
   {
      $url = $this->getApiUrl() . '/sendVideo';

      $originalName = pathinfo($video->getClientOriginalName(), PATHINFO_FILENAME);

      $response = Http::attach(
         'video',
         file_get_contents($video),
         $originalName . '.' . $video->getClientOriginalExtension()
      )->post($url, [
         'chat_id' => $chatId,
         'caption' => $caption,
      ]);

      return $response->json();
   }

   public function sendAnimation($chatId, $animation, $caption = '')
   {
      $url = $this->getApiUrl() . '/sendAnimation';

      $originalName = pathinfo($animation->getClientOriginalName(), PATHINFO_FILENAME);

      $response = Http::attach(
         'animation',
         file_get_contents($animation),
         $originalName . '.' . $animation->getClientOriginalExtension()
      )->post($url, [
         'chat_id' => $chatId,
         'caption' => $caption,
      ]);

      return $response->json();
   }

   public function sendVoice($chatId, $voice, $caption = '')
   {
      $url = $this->getApiUrl() . '/sendVoice';

      $originalName = pathinfo($voice->getClientOriginalName(), PATHINFO_FILENAME);

      $response = Http::attach(
         'voice',
         file_get_contents($voice),
         $originalName . '.' . $voice->getClientOriginalExtension()
      )->post($url, [
         'chat_id' => $chatId,
         'caption' => $caption,
      ]);

      return $response->json();
   }

   public function sendLocation($chatId, $latitude, $longitude, $caption = '')
   {
      $url = $this->getApiUrl() . '/sendLocation';

      $response = Http::post($url, [
         'chat_id' => $chatId,
         'latitude' => $latitude,
         'longitude' => $longitude,
         'caption' => $caption,
      ]);

      return $response->json();
   }

   public function sendContact($chatId, $phoneNumber, $firstName, $lastName = '')
   {
      $url = $this->getApiUrl() . '/sendContact';

      $response = Http::post($url, [
         'chat_id' => $chatId,
         'phone_number' => $phoneNumber,
         'first_name' => $firstName,
         'last_name' => $lastName,
      ]);

      return $response->json();
   }

   public function sendPoll($chatId, $question, $options)
   {
      $url = $this->getApiUrl() . '/sendPoll';

      $response = Http::post($url, [
         'chat_id' => $chatId,
         'question' => $question,
         'options' => json_encode($options),
      ]);

      return $response->json();
   }
}
