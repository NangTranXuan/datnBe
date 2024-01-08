<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request) {
        $user = User::where('email', $request->email)->first();
//        return $user;

        if (!$user || !Hash::check($request->password, $user->password, [])) {
            return response()->json(
                [
                    'message' => 'User not exist!'
                ],
                404
            );
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(
            [
                'access_token' => $token,
                'type_token' => 'Bearer',
            ],
            200
        );
    }

    public function index(Request $request) {
        return $request->user();
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json(
            $data = "ok",
            $status = 200,
        );
    }
}
