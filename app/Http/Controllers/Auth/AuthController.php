<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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

            return response()->json(['token' => $token]);
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
        return response()->json(['token' => $newToken]);
    }
}
