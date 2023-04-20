<?php

namespace AnthonyEdmonds\LaravelSilverowl\Tests\Unit\Models\User\Setters;

use AnthonyEdmonds\SilverOwl\Models\User;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class PasswordTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->make();
        $this->user->password = 'My cool password';
    }

    public function testHashesPassword(): void
    {
        $this->assertTrue(
            Hash::check('My cool password', $this->user->password)
        );
    }
}
