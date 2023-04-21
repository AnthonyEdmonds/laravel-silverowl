<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Controllers\SignIn;

use AnthonyEdmonds\SilverOwl\Http\Controllers\SignInController;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Contracts\View\View;

class FormTest extends TestCase
{
    protected SignInController $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = new SignInController();
        $this->view = $this->controller->form();
    }

    public function testHasView(): void
    {
        $this->assertEquals(
            'silverowl::sign-in',
            $this->view->name(),
        );
    }
}
