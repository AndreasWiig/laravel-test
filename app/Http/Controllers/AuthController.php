<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = $request->createUser();
        $token = $user->createToken('secret')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(LoginUserRequest $request)
    {
        if($request->checkCredentials()) {
             return response()->json(['message' => 'incorrect credentials'], 401);
        }
        $existingUser = $request->existingUser();
        $existingUser->logIpEntry();


        return response()->json([
            'user' => $existingUser,
            'token' => $request->generateToken(),
        ], 201);

    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'You logged out of system'
        ]);
    }


}
