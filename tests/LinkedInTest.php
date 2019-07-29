<?php
declare(strict_types=1);

namespace AlwaysBlank\Extrovert\Tests;


use AlwaysBlank\Extrovert\Network\LinkedIn;
use PHPUnit\Framework\TestCase;

class LinkedInTest extends TestCase
{
    public function testGetCorrectUrl(): void
    {
        $expected = 'https://www.linkedin.com/shareArticle?mini=true&url=https%3A%2F%2Fwww.alwaysblank.org';
        $this->assertEquals(
            $expected,
            LinkedIn::url(
                Constants::TEST_URL,
                Constants::TEST_TITLE,
                Constants::TEST_DESCRIPTION
            )
        );
    }
}