<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(Request $request)
    {
        return response()->json([
            'data' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function callback(Request $request)
    {
        if ($request->get('error') == 'access_denied') {
            return redirect('login');
        }
        $user = Socialite::driver('google')->stateless()->user();
        $findUser = User::where('social_id', $user->id)->first();
        if ($findUser) {
            $token = Auth::login($findUser);
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
                'social_provider' => 'google',
                'social_id' => $user->id,
                // 'password' => Hash::make(12345678)
            ]);

            $token = Auth::login($newUser);
            $newUser["access_token"] = $token;
            return response()->json([
                'data' => $newUser,
                'message' => 'Ok',
            ]);
        }
    }
}
