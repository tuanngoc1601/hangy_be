<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        $user = new User();
        // $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->username = $credentials['username'];
        $user->password = bcrypt($credentials['password']);
        $user->save();

        $token = auth('api')->login($user);

        $refreshToken = $this->generateRefreshToken();

        Auth::user()->update(['refresh_token' => $refreshToken]);

        return $this->respondWithToken($token);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $refreshToken = $this->generateRefreshToken();

        Auth::user()->update(['refresh_token' => $refreshToken]);

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json([
            'message' => "Ok",
            'user' => Auth::user(),
        ], 200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json(['data' => 'Successfully logged out'], 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $request): JsonResponse
    {
        $refreshToken = $request->refresh_token;
        try {
            $decode = JWTAuth::getJWTProvider()->decode($refreshToken);

            $user = User::find($decode['sub']);

            if (!$user) {
                return response()->json(['message' => 'user not found'], 404);
            }

            $newToken = auth('api')->login($user);

            return $this->respondWithToken($newToken);
        } catch (JWTException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 500);
        }
    }

    /**
     * Generate refresh token when user login
     */
    protected function generateRefreshToken()
    {
        $data = [
            'random' => rand() . time(),
            'iat' => time(),
            'exp' => time() + config('jwt.refresh_ttl'),
            'sub' => Auth::user()->id,
        ];

        $refreshToken = JWTAuth::getJWTProvider()->encode($data);

        return $refreshToken;
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        $user = Auth::user();
        $user['access_token'] = $token;
        return response()->json([
            'data' => $user,
            'message' => 'Ok',
        ], 200);
    }
}
