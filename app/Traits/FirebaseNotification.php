<?php

namespace App\Traits;

use App\Models\DeviceToken;
use App\Models\Notification;

trait FirebaseNotification
{

    public function sendFcm(array $data, $user_id = null)
    {
        $apiUrl = 'https://fcm.googleapis.com/v1/projects/travelclup-e8728/messages:send';
        $accessToken = $this->getAccessToken();

        $deviceTokens = [];

        if ($user_id) {
            $deviceToken = DeviceToken::where('user_id', $user_id)->first();
            if ($deviceToken) $deviceTokens[] = $deviceToken->token;

            Notification::create([
                'title' => $data['title'],
                'message' => $data['body'],
            ]);
        } else {
            $userIds = DeviceToken::pluck('user_id')->unique();
            $deviceTokens = DeviceToken::whereIn('user_id', $userIds)->pluck('token')->toArray();

            foreach ($userIds as $uid) {
                Notification::create([
                    'title' => $data['title'],
                    'message' => $data['body'],
                ]);
            }
        }

        $responses = [];
        foreach ($deviceTokens as $token) {
            $payload = $this->preparePayload($data, $token);
            $responses[] = $this->sendNotification($apiUrl, $accessToken, $payload);
        }

        return $responses;
    }

    protected function getAccessToken()
    {
        $credentialsFilePath = storage_path('app/firebase/travelclup-firebase.json');
        $client = new \Google_Client();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();

        return $client->getAccessToken()['access_token'];
    }

    protected function preparePayload(array $data, string $token)
    {
        $message = [
            'notification' => [
                'title' => $data['title'],
                'body' => $data['body'],
            ],
            'data' => [
                'reference_id' => (string)($data['reference_id'] ?? ''),
                'reference_table' => (string)($data['reference_table'] ?? ''),
                'reference_name' => (string)($data['title'] ?? ''),
            ],
            'token' => $token,
        ];

        return json_encode(['message' => $message]);
    }

    protected function sendNotification(string $url, string $accessToken, string $payload)
    {
        $headers = [
            "Authorization: Bearer " . $accessToken,
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            return ['error' => $error_msg];
        }

        $info = curl_getinfo($ch);
        curl_close($ch);

        return ['response' => json_decode($response, true), 'info' => $info];
    }
}
