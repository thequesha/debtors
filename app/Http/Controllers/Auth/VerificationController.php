<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'verify']);
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.verify');
    }

    /**
     * Resend the email verification notification for non-authenticated users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resendGuest(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user && $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
        }

        return back()->with('resent', true);
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(\Illuminate\Http\Request $request)
    {
        $user = \App\Models\User::find($request->route('id'));

        if (!$user) {
            return redirect()->route('login')
                ->with('message', 'Пользователь не найден.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')
                ->with('message', 'Ваш адрес электронной почты уже подтвержден.');
        }

        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return redirect()->route('login')
                ->with('message', 'Недействительная ссылка для подтверждения.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')
                ->with('message', 'Ваш адрес электронной почты уже подтвержден.');
        }

        if ($user->markEmailAsVerified()) {
            // Log the user in automatically after verification
            auth()->login($user);

            // Set a session flag to bypass verification check on the first redirect
            session(['verified_email' => true]);

            return redirect()->route('index');
        }

        return redirect()->route('login')
            ->with('message', 'Ошибка при подтверждении адреса электронной почты.');
    }
}
