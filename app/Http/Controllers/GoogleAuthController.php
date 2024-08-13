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
    public function redirect(Request $request)
    {
        return response()->json([
            'data' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function callback(Request $request)
    {
//      try {
        if ($request->get('error') == 'access_denied') {
            return redirect('login');
        }
        $user = Socialite::driver('google')->stateless()->user();
        $findUser = User::where('google_id', $user->id)->first();
        if ($findUser) {
            Auth::login($findUser);
//                $user['access_token'] = $token;
            return response()->json([
                'data' => $findUser,
                'message' => 'Ok',
            ]);
        } else {
            $newUser = User::updateOrCreate(['email' => $user->email], [
                'name' => $user->name,
                'username' => $user->email,
                'google_id' => $user->id,
                'password' => Hash::make(12345678)
            ]);

            Auth::login($newUser);
//                $newUser['access_token'] = $token;
            return response()->json([
                'data' => $newUser,
                'message' => 'Ok',
            ]);
        }
//      } catch (Exception $e) {
//          dd($e->getMessage());
//      }
    }
}
