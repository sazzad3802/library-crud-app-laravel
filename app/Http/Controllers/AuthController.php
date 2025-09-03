<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    // Register user
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $path = $request->file('image')->store('profile_images', 'public');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // bcrypt hash password
            'password' => bcrypt($request->password),
            'image_url' => '/storage/' . $path,
        ]);

        $token = JWTAuth::fromUser($user);

        return $this->respondWithToken($token);
    }

    // Login user and return token
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = JWTAuth::user();
        
        return $this->respondUserWithToken($token, $user);
    }

    // Logout user (invalidate the token)
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Successfully logged out']);
    }

    // Get the authenticated user profile
    public function me()
    {
        return response()->json(JWTAuth::user());
    }

    // Refresh a token
    public function refresh()
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());
            return $this->respondWithToken($newToken);
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Token refresh failed',
                'message' => $e->getMessage()
            ], 401);
        }

        // try {
        //     return $this->respondWithToken(JWTAuth::refresh());
        // } catch (JWTException $e) {
        //     return response()->json(['error' => 'Token is invalid or expired'], 401);
        // }
    }

    // Helper to respond with token structure
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60  // token expiry in seconds
        ]);
    }


    // Helper to respond with token structure
    protected function respondUserWithToken($token, $user)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60,  // token expiry in seconds
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'image_url' => $user->image_url ? url($user->image_url) : null,
            ],
        ]);
    }
}
