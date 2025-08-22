<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class TokenService
{
    public static function refreshToken($refreshToken)
    {
        try {
            $client = new Client();
            $response = $client->post('https://firebase-wishlist-user-item.ismail-biswas.workers.dev/refresh', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([ 'token' => $refreshToken ]),
                'timeout' => 30
            ]);

            $data = json_decode($response->getBody(), true);
                dd($data);
            // Update session with new tokens (assume response fields: idToken, refreshToken)
            session(['id_token' => $data['idToken'] ?? null]);
            session(['refresh_token' => $data['refreshToken'] ?? $refreshToken]);

            return $data['idToken'] ?? null;

        } catch (\Exception $e) {
            Log::error('Token refresh failed', [
                'error' => $e->getMessage(),
                'refresh_token' => substr($refreshToken, 0, 20) . '...' // Log partial for security
            ]);
            return null;
        }
    }

    public static function getValidToken()
    {
        $idToken = session('id_token');
        $refreshToken = session('refresh_token');

        // Simple check - in real app you might want to decode JWT to check expiry
        if (!$idToken && $refreshToken) {
            return self::refreshToken($refreshToken);
        }

        return $idToken;
    }
}
