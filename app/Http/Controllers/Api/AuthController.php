<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            if (!Auth::attempt($request->only(['username', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('username', $request->username)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'data' => array(
                    'nik' => $user->nik,
                    'username' => $user->username,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                )
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function registration(RegistrationRequest $request)
    {
        try {
            //Validated
            $user = User::create([
                'nik' => $request->nik,
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'role' => "user",
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'data' => array(
                    'nik' => $user->nik,
                    'username' => $user->username,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                )
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
