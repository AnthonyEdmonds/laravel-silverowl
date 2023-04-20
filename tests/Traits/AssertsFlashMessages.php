<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Traits;

/**
 * Test whether your Laracasts\Flash messages are working properly
 * Simply include this trait on your test and call the assert methods.
 *
 * @author Anthony Edmonds
 *
 * @link https://github.com/AnthonyEdmonds
 */
trait AssertsFlashMessages
{
    public function assertFlashed(
        string $message,
        string $level = null
    ): void {
        $flash = flash()
            ->messages
            ->where('message', $message)
            ->first();

        $this->assertNotNull($flash, "A message that reads \"$message\" was not found.");

        if ($level !== null) {
            $this->assertEquals(
                $level,
                $flash->level
            );
        }
    }
}
