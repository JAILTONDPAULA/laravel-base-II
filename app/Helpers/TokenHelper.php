<?php namespace App\Helpers;

class TokenHelper
{
    public static function generateNumericToken(): string
    {
        return sprintf('%06d', mt_rand(0, 999999)); // Gera um token de 6 dígitos
    }
}
