<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Commands;

use AnthonyEdmonds\SilverOwl\Models\User;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddUserTest extends TestCase
{
    use RefreshDatabase;

    /** @runInSeparateProcess */
    public function testCreatesUser(): void
    {
        $this->artisan('add:user')
            ->expectsQuestion('What is their username?', 'Anthony Edmonds')
            ->expectsQuestion('What is their password?', 'myverysecretpassword')
            ->assertOk();

        $this->assertDatabaseHas('users', [
            'username' => 'Anthony Edmonds',
        ]);
    }

    /** @runInSeparateProcess */
    public function testUsernameMustNotBeNull(): void
    {
        $this->artisan('add:user')
            ->expectsQuestion('What is their username?', '')
            ->expectsOutput('You must provide a username.')
            ->expectsQuestion('What is their username?', 'Anthony Edmonds')
            ->expectsQuestion('What is their password?', 'myverysecretpassword')
            ->assertOk();
    }

    /** @runInSeparateProcess */
    public function testUsernameMustBeUnique(): void
    {
        $user = User::factory()->create();

        $this->artisan('add:user')
            ->expectsQuestion('What is their username?', $user->username)
            ->expectsOutput('Another User with that username already exists. You must pick a unique name.')
            ->expectsQuestion('What is their username?', 'Anthony Edmonds')
            ->expectsQuestion('What is their password?', 'myverysecretpassword')
            ->assertOk();
    }

    /** @runInSeparateProcess */
    public function testPasswordMustNotBeNull(): void
    {
        $this->artisan('add:user')
            ->expectsQuestion('What is their username?', 'Anthony Edmonds')
            ->expectsQuestion('What is their password?', '')
            ->expectsOutput('You must provide a password.')
            ->expectsQuestion('What is their password?', 'myverysecretpassword')
            ->assertOk();
    }

    /**
     * @runInSeparateProcess
     */
    public function testPasswordMustBeSixteenCharacters(): void
    {
        $this->artisan('add:user')
            ->expectsQuestion('What is their username?', 'Anthony Edmonds')
            ->expectsQuestion('What is their password?', 'tooshort')
            ->expectsOutput('That password is too short. You must use at least 16 characters.')
            ->expectsQuestion('What is their password?', 'myverysecretpassword')
            ->assertOk();
    }
}
