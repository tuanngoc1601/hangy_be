<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return response()->json([
            'data' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('google_id', $user->id)->first();
            if (!$findUser) {
                $token = Auth::login($findUser);
                $user['access_token'] = $token;
                return response()->json([
                    'data' => $findUser,
                    'message' => 'Ok',
                ]);
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'username' => $user->name,
                    'google_id' => $user->id,
                    'password' => Hash::make(String::random(8))
                ]);

                $token = Auth::login($newUser);
                $newUser['access_token'] = $token;
                return response()->json([
                    'data' => $newUser,
                    'message' => 'Ok',
                ]);
            }

            return response()->json([
                'data' => $user,
                'message' => 'OK',
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
