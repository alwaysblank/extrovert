<?php
declare(strict_types=1);

namespace AlwaysBlank\Extrovert\Tests;


use AlwaysBlank\Extrovert\Network\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testGetCorrectUrl(): void
    {
        $expected = 'mailto:?subject=Extrovert, for simple sharing&body=Check out this link: https://www.alwaysblank.org';
        $this->assertEquals(
            $expected,
            Email::url(
                Constants::TEST_URL,
                Constants::TEST_TITLE,
                "Check out this link: %s"
            )
        );
    }

    public function testWithoutSubject(): void
    {
        $expected = 'mailto:?subject=Suggested link&body=Check out this link: https://www.alwaysblank.org';
        $this->assertEquals(
            $expected,
            Email::url(
                Constants::TEST_URL,
                false,
                "Check out this link: %s"
            )
        );
    }

    public function testWithoutBody(): void
    {
        $expected = 'mailto:?subject=Extrovert, for simple sharing&body=Visit https://www.alwaysblank.org';
        $this->assertEquals(
            $expected,
            Email::url(
                Constants::TEST_URL,
                Constants::TEST_TITLE
            )
        );
    }
}