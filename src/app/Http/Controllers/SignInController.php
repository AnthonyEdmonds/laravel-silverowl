<?php

namespace AnthonyEdmonds\SilverOwl\Http\Controllers;

use AnthonyEdmonds\SilverOwl\Http\Requests\SignInRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function form(): View
    {
        return view('silverowl::sign-in');
    }

    public function signIn(SignInRequest $request): RedirectResponse
    {
        $details = [
            'username' => strtolower($request->username),
            'password' => $request->password,
        ];

        return Auth::attempt($details, true) === true
            ? $this->loginSucceeded()
            : $this->loginFailed($details['username']);
    }

    public function signOut(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('home');
    }

    protected function loginFailed(string $username): RedirectResponse
    {
        flash()->error('Sign-in failed');

        return redirect()
            ->route('sign-in')
            ->withInput([
                'username' => $username,
            ]);
    }

    protected function loginSucceeded(): RedirectResponse
    {
        flash()->success('You have successfully signed in');

        return redirect()->intended();
    }
}
