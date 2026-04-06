<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\EmailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\User;
use App\Services\EmailService;
use App\Services\ResetPassword;
use App\Services\ValidarUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response($validator->errors()->first(), 422);
        }

        try {
            $credentials = $request->only('email', 'password');
            // * <=====> via autenticação banco de dados <=====> * //
            $token       = JWTAuth::attempt($credentials);
            // * <=====> via autenticação externa <=====> * //
            // ! implementar autenticação externa, exemplo: LDAP, AD, etc...
            // $user        = User::where('email', $credentials['email'])->first();
            // if (!$user) {
            //     return response('Não autenticado', 401);
            // }
            // $token       = JWTAuth::fromUser($user);
            // * <=====> via autenticação externa <=====> * //
            if (!$token) {
                return response('Não autenticado', 401);
            }

            return response()->json([
                'token' => $token,
                'expires_in' => JWTAuth::factory()->getTTL() * 60, // em segundos
                'user' => JWTAuth::user()
            ]);
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        $newToken = JWTAuth::refresh(JWTAuth::getToken());
        return response()->json([
            'token' => $newToken,
            'expires_in' => JWTAuth::factory()->getTTL() * 60, // em segundos
            'user' => JWTAuth::user()
        ]);
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response($validator->errors()->first(), 422);
        }

        try {
            $resetPassword = new ResetPassword($request->email);
            $resetPassword->resetPassword();
            $token = $resetPassword->token->token;
            $user  = $resetPassword->user;
            EmailHelper::sendPasswordResetEmail(
                view: 'emails.password-reset',
                data: [
                    'name'      => $user->name,
                    'token'     => $token,
                    'resetUrl' => route('reset', ['token' => base64_encode($token), 'email' => base64_encode($user->email)]),
                    'url'      => route('reset', ['token' => base64_encode($token), 'email' => base64_encode($user->email)]),
                    'showToken' => true
                ],
                to: $user->email,
                subject: '🔐 Redefinição de Senha - ' . config('app.name')
            );
            return response()->json(['message' => 'Link de reset enviado para o e-mail informado']);
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }
}
