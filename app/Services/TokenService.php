<?php namespace App\Services;

use App\Models\Token;

class TokenService
{
    public static function valid($email, $token): bool
    {
        $token = Token::where('email', $email)->where('token', $token)->first();
        if(!$token) {
            throw new \Exception('Token inválido');
        }

        // Valida se o token foi criado há mais de 5 minutos
        if($token->created_at && $token->created_at->lt(now()->subMinutes(5))) {
            throw new \Exception('Token expirado - criado há mais de 5 minutos');
        }

        if($token->registrado < now()) {
            throw new \Exception('Token expirado');
        }

        return true;
    }
}
