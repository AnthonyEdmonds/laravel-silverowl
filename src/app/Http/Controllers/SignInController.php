<?php

namespace AnthonyEdmonds\SilverOwl\Http\Controllers;

use AnthonyEdmonds\SilverOwl\Http\Requests\StoreContentRequest;
use AnthonyEdmonds\SilverOwl\Models\Content;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SignInController extends Controller
{
    public function create(): View
    {
        // TODO Show sign in form
    }

    public function store(): View
    {
        // TODO Sign in
    }

    public function destroy(): View
    {
        // TODO Sign out
    }
}
