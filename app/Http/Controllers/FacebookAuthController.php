<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class FacebookAuthController extends Controller
{
    public function redirect(Request $request)
    {
        return response()->json([
            'data' => Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function callback(Request $request)
    {
        if ($request->get('error') == 'access_denied') {
            return redirect('login');
        }

        $user = Socialite::driver('facebook')->stateless()->user();

        $findUser = User::where('social_id', $user->id)->first();

        if ($findUser) {
            $token = Auth::login($findUser);

            $this->storeRefreshToken();

            $findUser["access_token"] = $token;

            return response()->json([
                'data' => $findUser,
                'message' => 'Ok',
            ]);
        } else {
            $newUser = User::updateOrCreate([
                'email' => $user->email,
                'name' => $user->name,
                'email_verified_at' => Carbon::now(),
                'social_provider' => 'facebook',
                'social_id' => $user->id,
            ]);

            $token = Auth::login($newUser);

            $this->storeRefreshToken();

            $newUser["access_token"] = $token;

            return response()->json([
                'data' => $newUser,
                'message' => 'Ok',
            ]);
        }
    }

    protected function storeRefreshToken()
    {
        $data = [
            'random' => rand() . time(),
            'iat' => time(),
            'exp' => time() + config('jwt.refresh_ttl'),
            'sub' => Auth::user()->id,
        ];

        $refreshToken = JWTAuth::getJWTProvider()->encode($data);

        Auth::user()->update(['refresh_token' => $refreshToken]);
    }
}
