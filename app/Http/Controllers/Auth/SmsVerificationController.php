<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SmsVerificationController extends Controller
{
    /**
     * Show the SMS verification form
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('auth.verify-sms');
    }

    /**
     * Verify the OTP code
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:4',
        ]);

        // In a real implementation, we would check the OTP against a stored value
        // For now, we'll check against the session value
        if ($request->otp == session('otp')) {
            // If phone is in session, we can log the user in
            if (session('phone')) {
                $user = User::where('phone', session('phone'))->first();

                if ($user) {
                    Auth::login($user);
                    return redirect()->route('index');
                }
            }

            return redirect()->route('login')
                ->with('message', 'Верификация успешна! Пожалуйста, войдите в систему.');
        }

        return back()->withErrors(['otp' => 'Неверный код подтверждения.']);
    }

    /**
     * Resend the verification code
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        // Generate a new OTP
        $otp = random_int(1000, 9999);

        // Store in session
        session()->put('otp', $otp);

        return back()->with('resent', true)->with('otp', $otp);
    }

    /**
     * Show the forgot password form
     *
     * @return \Illuminate\View\View
     */
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle forgot password verification
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|exists:users,phone',
            'otp' => 'required|numeric|digits:4',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Clean phone number
        $phone = preg_replace('/[^0-9]/', '', $request->phone);
        // Remove leading 7 if present
        if (strlen($phone) > 10 && substr($phone, 0, 1) == '7') {
            $phone = substr($phone, 1);
        }

        // In a real implementation, we would check the OTP against a stored value
        // For now, we'll assume the OTP is correct since it's a dummy implementation

        // Find user by phone
        $user = User::where('phone', $phone)->first();

        if (!$user) {
            return redirect()->route('password.request')
                ->with('message', 'Пользователь не найден.');
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')
            ->with('message', 'Пароль успешно изменен. Пожалуйста, войдите в систему с новым паролем.');
    }

    /**
     * Show reset password form
     *
     * @return \Illuminate\View\View
     */
    public function showResetForm()
    {
        return view('auth.reset-password');
    }

    /**
     * Reset the password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|exists:users,phone',
            'otp' => 'required|numeric|digits:4',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Clean phone number
        $phone = $request->phone;


        // In a real implementation, we would check the OTP against a stored value
        // For now, we'll assume the OTP is correct since it's a dummy implementation
        // and we're showing it in a toast notification

        // Find user by phone
        $user = User::where('phone', $phone)->first();

        if (!$user) {
            return redirect()->route('login')
                ->with('message', 'Пользователь не найден.');
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')
            ->with('message', 'Пароль успешно изменен. Пожалуйста, войдите в систему с новым паролем.');
    }
}
