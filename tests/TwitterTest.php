<?php


namespace AlwaysBlank\Extrovert\Tests;


use AlwaysBlank\Extrovert\Network\Twitter;
use PHPUnit\Framework\TestCase;

class TwitterTest extends TestCase
{
    public function testGetCorrectUrl(): void
    {
        $expected = 'https://twitter.com/share?url=https%3A%2F%2Fwww.alwaysblank.org&text=Extrovert%2C+for+simple+sharing';
        $this->assertEquals(
            $expected,
            Twitter::url(
                Constants::TEST_URL,
                Constants::TEST_TITLE,
                Constants::TEST_DESCRIPTION
            )
        );
    }
}