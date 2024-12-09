<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware(): array {
        return [
            new Middleware('auth:api', except: ['login', 'signup'])
        ];
    }

    public function login() {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response([
                'error' => 'Authentication failed',
            ], 401);
        }

        return response([
            'data' => $this->respondWithToken($token),
            'msg' => 'User logged in successfully'
        ]);
    }

    public function signup(Request $request) {
        $validated_data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create($validated_data);

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response([
                'error' => 'Authentication failed',
            ], 401);
        }

        return response([
            'data' => array_merge([
                'user' => $user
            ], $this->respondWithToken($token)),
            'msg' => 'User registered succussfully'
        ]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    private function respondWithToken(string $token) {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
