<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\TokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class TokenController extends Controller
{
    public function valid(Request $request)
    {
        $valiadator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string'
        ]);
        if($valiadator->fails()) {
            return response($valiadator->errors()->first(), 422);
        }
        try {
            TokenService::valid($request->email, $request->token);
            return response()->json(['valid' => true]);
        } catch (Throwable $th) {
            return response($th->getMessage(), 401);
        }
    }
}
