<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Controllers\SignIn;

use AnthonyEdmonds\SilverOwl\Http\Controllers\SignInController;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SignOutTest extends TestCase
{
    protected SignInController $controller;

    protected RedirectResponse $redirect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->signIn();

        $this->controller = new SignInController();
        $this->redirect = $this->controller->signOut();
    }

    public function testSignsOut(): void
    {
        $this->assertFalse(Auth::check());
    }

    public function testRedirects(): void
    {
        $this->assertEquals(
            route('home'),
            $this->redirect->getTargetUrl(),
        );
    }
}
