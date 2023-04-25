<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Helpers\PageHelper;

use AnthonyEdmonds\SilverOwl\Helpers\PageHelper;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class LoadFooterLinksTest extends TestCase
{
    const FOOTER_LINKS = [
        'First link' => 'First route',
        'Second link' => 'Second route',
        'Third link' => 'Third route',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('silverowl.footer.links', self::FOOTER_LINKS);
    }

    public function testHasFooterLinks(): void
    {
        $this->assertEquals(
            self::FOOTER_LINKS,
            PageHelper::loadFooterLinks(),
        );
    }
}
