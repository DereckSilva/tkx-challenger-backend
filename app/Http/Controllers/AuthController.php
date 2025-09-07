<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status'  => true,
                'message' => 'Login Efetuado com Sucesso',
                'data'    => [
                    'token' => $request->user()->createToken('token-challenge', ['*'], now()->addDay())->plainTextToken,
                    'user'  => [
                        'email' => $request->user()->email,
                        'id'    => $request->user()->id,
                        'name'  => $request->user()->name
                    ]
                ]
            ], 200);
        }
        return response()->json([
            'status'  => false,
            'message' => 'Usuário não autorizado!',
        ], 403);
    }

    public function logout(Request $request) {

        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status'  => true,
            'message' => 'Logout efetuado com sucesso.'
        ], 200);
    }
}
