<?php namespace App\Services;

use App\Models\User;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class JwtAuthService
{

    public function login(array $credentials): ?string
    {
        try {
            return JWTAuth::attempt($credentials);
        } catch (\Throwable $th) {
            throw new Exception('Erro ao autenticar');
        }
    }

    public function generateToken(User $user): ?string
    {
        return JWTAuth::fromUser($user);
    }

    public function user()
    {
        try {
            return JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            return null;
        }
    }

    public function logout(): void
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (Exception $e) {
            throw new Exception('Erro ao autenticar no logout');
        }
    }

    public function refresh(): array
    {
        return JWTAuth::refresh(JWTAuth::getToken());
    }

}
