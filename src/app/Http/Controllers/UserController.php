<?php

namespace AnthonyEdmonds\SilverOwl\Http\Controllers;

use AnthonyEdmonds\SilverOwl\Http\Requests\StoreUserRequest;
use AnthonyEdmonds\SilverOwl\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        // TODO List all Users
    }

    public function create(): View
    {
        // TODO Create a User
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        // TODO Store a created User
    }

    public function show(User $user): View
    {
        // TODO List all content with this User
    }

    public function edit(User $user): View
    {
        // TODO Edit a User
    }

    public function update(StoreUserRequest $request, User $user): RedirectResponse
    {
        // TODO Update the edited User
    }

    public function destroy(User $user): RedirectResponse
    {
        // TODO Destroy the User
    }
}
