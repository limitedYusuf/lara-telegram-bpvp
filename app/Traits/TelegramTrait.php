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

   public function sendAudio($chatId, $audio, $caption = '')
   {
      $url = $this->getApiUrl() . '/sendAudio';

      $originalName = pathinfo($audio->getClientOriginalName(), PATHINFO_FILENAME);

      $response = Http::attach(
         'audio',
         file_get_contents($audio),
         $originalName . '.' . $audio->getClientOriginalExtension()
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

   public function sendPollV1($chatId, $question, $options)
   {
      $url = $this->getApiUrl() . '/sendPoll';

      $response = Http::post($url, [
         'chat_id' => $chatId,
         'question' => $question,
         'options' => json_encode($options),
      ]);

      return $response->json();
   }

   public function sendPollV2($chatId, $question, $options, $isAnonymous = false, $type = 'regular', $allowsMultipleAnswers = false, $correctOptionId = null, $explanation = '', $explanationParseMode = '', $openPeriod = null, $closeDate = null)
   {
      $url = $this->getApiUrl() . '/sendPoll';

      $response = Http::post($url, [
         'chat_id' => $chatId,
         'question' => $question,
         'options' => json_encode($options),
         'is_anonymous' => $isAnonymous,
         'type' => $type,
         'allows_multiple_answers' => $allowsMultipleAnswers,
         'correct_option_id' => $correctOptionId,
         'explanation' => $explanation,
         'explanation_parse_mode' => $explanationParseMode,
         'open_period' => $openPeriod,
         'close_date' => $closeDate,
      ]);

      return $response->json();
   }

   public function sendInvoice($chatId, $title, $description, $payload, $providerToken, $startParameter, $currency, $prices)
   {
      $url = $this->getApiUrl() . '/sendInvoice';

      $response = Http::post($url, [
         'chat_id' => $chatId,
         'title' => $title,
         'description' => $description,
         'payload' => $payload,
         'provider_token' => $providerToken,
         'start_parameter' => $startParameter,
         'currency' => $currency,
         'prices' => json_encode($prices),
      ]);

      return $response->json();
   }

   public function getChat($chatId)
   {
      $url = $this->getApiUrl() . '/getChat';

      $response = Http::post($url, [
         'chat_id' => $chatId,
      ]);

      return $response->json();
   }

   public function getChatMemberCount($chatId)
   {
      $url = $this->getApiUrl() . '/getChatMemberCount';

      $response = Http::post($url, [
         'chat_id' => $chatId,
      ]);

      return $response->json();
   }

   public function setMyCommands($commands)
   {
      $url = $this->getApiUrl() . '/setMyCommands';

      $response = Http::post($url, [
         'commands' => json_encode($commands),
      ]);

      return $response->json();
   }

   public function setChatMenuButton($chatId, $menuText, $menuButtons)
   {
      $url = $this->getApiUrl() . '/sendMessage';

      $keyboard = [
         'keyboard' => $menuButtons,
         'resize_keyboard' => true,
         'one_time_keyboard' => true,
      ];

      $response = Http::post($url, [
         'chat_id' => $chatId,
         'text' => $menuText,
         'reply_markup' => json_encode($keyboard),
      ]);

      return $response->json();
   }

   public function copyMessage($chatId, $fromChatId, $messageId, $caption = '')
   {
      $url = $this->getApiUrl() . '/copyMessage';

      $response = Http::post($url, [
         'chat_id' => $chatId,
         'from_chat_id' => $fromChatId,
         'message_id' => $messageId,
         'caption' => $caption,
      ]);

      return $response->json();
   }

   public function sendDice($chatId, $emoji = '🎲')
   {
      $url = $this->getApiUrl() . '/sendDice';

      $response = Http::post($url, [
         'chat_id' => $chatId,
         'emoji' => $emoji,
      ]);

      return $response->json();
   }

   public function sendVenue($chatId, $latitude, $longitude, $title, $address, $foursquareId = '', $foursquareType = '', $googlePlaceId = '', $googlePlaceType = '')
   {
      $url = $this->getApiUrl() . '/sendVenue';

      $response = Http::post($url, [
         'chat_id' => $chatId,
         'latitude' => $latitude,
         'longitude' => $longitude,
         'title' => $title,
         'address' => $address,
         'foursquare_id' => $foursquareId,
         'foursquare_type' => $foursquareType,
         'google_place_id' => $googlePlaceId,
         'google_place_type' => $googlePlaceType,
      ]);

      return $response->json();
   }

   public function sendSticker($chatId, $sticker)
   {
      $url = $this->getApiUrl() . '/sendSticker';

      $response = Http::attach(
         'sticker',
         file_get_contents($sticker),
         basename($sticker)
      )->post($url, [
         'chat_id' => $chatId,
      ]);

      return $response->json();
   }

   public function editMessageText($chatId, $messageId, $text)
   {
      $url = $this->getApiUrl() . '/editMessageText';

      $response = Http::post($url, [
         'chat_id' => $chatId,
         'message_id' => $messageId,
         'text' => $text,
      ]);

      return $response->json();
   }

   public function deleteMessage($chatId, $messageId)
   {
      $url = $this->getApiUrl() . '/deleteMessage';

      $response = Http::post($url, [
         'chat_id' => $chatId,
         'message_id' => $messageId,
      ]);

      return $response->json();
   }

   public function getChatAdministrators($chatId)
   {
      $url = $this->getApiUrl() . '/getChatAdministrators';

      $response = Http::post($url, [
         'chat_id' => $chatId,
      ]);

      return $response->json();
   }

   public function kickChatMember($chatId, $userId)
   {
      $url = $this->getApiUrl() . '/kickChatMember';

      $response = Http::post($url, [
         'chat_id' => $chatId,
         'user_id' => $userId,
      ]);

      return $response->json();
   }

}
