<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Controllers\SignIn;

use AnthonyEdmonds\SilverOwl\Http\Controllers\SignInController;
use AnthonyEdmonds\SilverOwl\Http\Requests\SignInRequest;
use AnthonyEdmonds\SilverOwl\Models\User;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SignInTest extends TestCase
{
    protected SignInController $controller;

    protected RedirectResponse $redirect;

    protected SignInRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = new SignInController();

        User::factory()->create([
            'username' => 'jerald',
            'password' => 'secret',
        ]);
    }

    public function testSignsInOnSuccess(): void
    {
        $this->makeRequest(true);

        $this->assertTrue(Auth::check());
    }

    public function testRedirectsOnSuccess(): void
    {
        $this->makeRequest(true);

        $this->assertEquals(
            route('home'),
            $this->redirect->getTargetUrl(),
        );
    }

    public function testFlashesSuccess(): void
    {
        $this->makeRequest(true);

        $this->assertFlashed(
            'You have successfully signed in',
            'success',
        );
    }

    public function testDoesntSignInOnFailure(): void
    {
        $this->makeRequest(false);

        $this->assertFalse(Auth::check());
    }

    public function testRedirectsOnFailure(): void
    {
        $this->makeRequest(false);

        $this->assertEquals(
            route('sign-in'),
            $this->redirect->getTargetUrl(),
        );
    }

    public function testFlashesFailure(): void
    {
        $this->makeRequest(false);

        $this->assertFlashed(
            'Sign-in failed',
            'danger',
        );
    }

    protected function makeRequest(bool $succeed): void
    {
        $this->request = new SignInRequest([
            'username' => $succeed === true ? 'jerald' : 'jareld',
            'password' => $succeed === true ? 'secret' : 'sacret',
        ]);

        $this->redirect = $this->controller->signIn($this->request);
    }
}
