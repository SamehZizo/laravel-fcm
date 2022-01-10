<?php

namespace Sameh\LaravelFCM;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use function config;

class FCMManager
{
    private static $url = "https://fcm.googleapis.com/fcm/send";

    private static function send_request($server_key, array $data): Response
    {
        $headers = ['Content-Type' => 'application/json', 'Authorization' => "Bearer $server_key"];
        return Http::withHeaders($headers)->withToken($server_key)->post(self::$url, $data);
    }

    public static function topic_request_data(array $data, string $topic): array
    {
        return ['to' => "/topics/$topic", 'data' => $data];
    }

    public static function send_message_to_topic(array $data, string $topic, FCMManagerResponse $FCMManagerResponse = null)
    {
        $request_data = self::topic_request_data($data, $topic);
        self::make_request($request_data, $FCMManagerResponse);
    }

    public static function tokens_request_data(array $data, array $tokens): array
    {
        return ['data' => $data, 'registration_ids' => $tokens];
    }

    public static function send_message_to_tokens(array $data, array $tokens, FCMManagerResponse $FCMManagerResponse = null)
    {
        $request_data = self::tokens_request_data($data, $tokens);
        self::make_request($request_data, $FCMManagerResponse);
    }

    /**
     * @throws \Exception
     */
    private static function make_request($request_data, $FCMManagerResponse)
    {
        $response = self::send_request(self::get_server_key(), $request_data);
        self::get_response($response, $FCMManagerResponse);
    }

    /**
     * @throws \Exception
     */
    private static function get_response($response, $FCMManagerResponse)
    {
        switch ($response->status()) {
            case 401:
                throw new \Exception("Error 401 : Wrong server key !");
            case 200:
                if ($FCMManagerResponse) {
                    $FCMManagerResponse->onSuccess($response);
                }
                break;
            default:
                if ($FCMManagerResponse) {
                    $FCMManagerResponse->onError($response);
                }
        }
    }

    /**
     * @throws \Exception
     */
    private static function get_server_key(): string
    {
        if (config('app.firebase_server_key') === null) {
            throw new \Exception("Add firebase server key to config (config folder -> app.php file) with key 'firebase_server_key' .");
        }

        return config('app.firebase_server_key');
    }
}
