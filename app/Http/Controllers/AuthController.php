<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * User login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                "message" => "Email atau password salah.",
                "status" => false,
            ], 401);
        }

        return response([
            "message" => "Login berhasil",
            "token" => $user->createToken("auth_token")->plainTextToken,
            "status" => true,
        ], 200);
    }

    /**
     * Logout
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response([
            "message" => "Logout berhasil",
            "status" => true,
        ], 200);
    }
}
