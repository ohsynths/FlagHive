<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    private const int MAX_LOGIN_ATTEMPTS = 5;
    private const int LOCKOUT_MINUTES = 15;

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $lockKey = 'login_lockout:' . $credentials['email'];

        if (Cache::has($lockKey)) {
            $seconds = Cache::get($lockKey) - now()->timestamp;
            return back()->withErrors([
                'email' => 'Account temporarily locked. Try again in ' . ceil($seconds / 60) . ' minutes.',
            ]);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Cache::forget('login_attempts:' . $credentials['email']);
            Cache::forget($lockKey);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'user.login',
                'description' => 'Logged in',
            ]);

            return redirect()->route('home');
        }

        $attemptsKey = 'login_attempts:' . $credentials['email'];
        $attempts = (int) Cache::get($attemptsKey, 0) + 1;
        Cache::put($attemptsKey, $attempts, now()->addHour());

        if ($attempts >= self::MAX_LOGIN_ATTEMPTS) {
            Cache::put($lockKey, now()->addMinutes(self::LOCKOUT_MINUTES)->timestamp, now()->addMinutes(self::LOCKOUT_MINUTES));
            Cache::forget($attemptsKey);
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[^A-Za-z0-9]/',
            ],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'password_changed_at' => now(),
        ]);

        event(new Registered($user));

        Auth::login($user);

        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'user.registered',
            'description' => "Registered as \"{$user->name}\"",
        ]);

        return redirect()->route('verification.notice');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function showForgotPassword()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        Password::sendResetLink($request->only('email'));

        return back()->with('success', 'If that email is registered, a password reset link has been sent.');
    }

    public function showResetPassword($token)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[^A-Za-z0-9]/',
            ],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'password_changed_at' => now(),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            ActivityLog::create([
                'user_id' => User::where('email', $request->email)->first()?->id,
                'action' => 'password.reset',
                'description' => 'Password reset',
            ]);

            return redirect()->route('login')->with('success', 'Password has been reset.');
        }

        return back()->withErrors(['email' => 'Unable to reset password.']);
    }
}
