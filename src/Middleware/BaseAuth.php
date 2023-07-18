<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Exception\AuthException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

abstract class BaseAuth {
    protected function checkToken(string $token): object{
        try {
            return JWT::decode($token, new Key($_SERVER['SECRET_KEY'], 'HS256'));
        } catch (\UnexpectedValueException $e) {
            throw new AuthException('Proibido: você não está autorizado.', 403);
        }
    }
}
