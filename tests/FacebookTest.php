<?php
declare(strict_types=1);

namespace AlwaysBlank\Extrovert\Tests;

use AlwaysBlank\Extrovert\Network\Facebook;
use PHPUnit\Framework\TestCase;

class FacebookTest extends TestCase
{
    public function testGetCorrectUrl(): void
    {
        $expected = sprintf(Facebook::BASE . Facebook::URI_TEMPLATE, Constants::TEST_ENCODED);
        $this->assertEquals($expected, Facebook::url(Constants::TEST_URL));
    }

    public function testInvalidUri(): void
    {
        $this->assertEmpty(
            Facebook::url(['name' => 'Invalid'])
        );
    }
}