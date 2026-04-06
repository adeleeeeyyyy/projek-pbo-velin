<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            if (empty($googleUser->email)) {
                return redirect()->route('login')
                    ->withErrors(['email' => 'No email returned from Google account.']);
            }

            $user = User::where('google_id', $googleUser->id)
                ->orWhere('email', $googleUser->email)
                ->first();

            if (!$user) {
                $user = User::create([
                    'name'      => $googleUser->name ?? explode('@', $googleUser->email)[0],
                    'email'     => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'provider'  => 'google',
                    'avatar'    => $googleUser->avatar,
                    'password'  => bcrypt(Str::random(24)),
                    'role_name' => 'User',
                    'status'    => 'Active',
                    'join_date' => now()->format('Y-m-d H:i:s'),
                ]);
            } else {
                // Update existing user if they don't have google_id linked
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->id,
                        'provider'  => 'google',
                        'avatar'    => $googleUser->avatar,
                    ]);
                }
            }

            $user->update([
                'last_login' => now()->format('Y-m-d H:i:s'),
            ]);

            Auth::login($user);

            return redirect()->intended(route('dashboard', absolute: false));

        } catch (\Exception $e) {
            Log::error('Google OAuth Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('login')
                ->withErrors(['email' => 'Authentication failed. Please try again.']);
        }
    }
}
