<?php

namespace App\Infrastructure\Service;

use Symfony\Component\HttpFoundation\Response;

class TokenChecker
{
    private string $envToken;

    public function __construct()
    {
        // Получаем токен из .env файла
        $this->envToken = $_ENV['API_TOKEN'];
    }

    public function check($request)
    {
        $authHeader = $request->headers->get('Authorization');

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        } else {
            return new Response(json_encode(['message' => 'Not found Bearer']), 401);
        }

        if (!$this->checkToken($token)) {
            return new Response(json_encode(['message' => 'Invalid token']), 403);
        }
    }

    public function checkToken(string $token): bool
    {
        return $token === $this->envToken;
    }
}