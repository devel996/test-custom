<?php

declare(strict_types=1);

namespace app\application;

class Csrf
{
    public static function generateToken(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $token = bin2hex(uniqid());

        $_SESSION['csrf_token'] = $token;

        return $token;
    }

    public static function validateToken(string $token): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] === $token) {
            return true;
        }

        return false;
    }
}