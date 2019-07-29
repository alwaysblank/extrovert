<?php
declare(strict_types=1);

namespace AlwaysBlank\Extrovert\Tests;


use PHPUnit\Framework\TestCase;

class NetworkTest extends TestCase
{

    public const EXPECTED_URL = 'http://test.com/?uri=https%3A%2F%2Fwww.alwaysblank.org&name=Extrovert%2C+for+simple+sharing&description=This+library%2C+Extrovert%2C+can+make+building+websites+easier+by+taking+something+off+your+%F0%9F%8D%BD.';

    public function testSimpleInvocation(): void
    {
        $this->assertEquals(
            self::EXPECTED_URL,
            FakeNetwork::url(
                Constants::TEST_URL,
                Constants::TEST_TITLE,
                Constants::TEST_DESCRIPTION
            )
        );
    }

    public function testNonStandardArgumentFormats(): void
    {
        $this->assertEquals(
            self::EXPECTED_URL,
            FakeNetwork::url([
                Constants::TEST_URL,
                Constants::TEST_TITLE,
                Constants::TEST_DESCRIPTION
            ])
        );
        $this->assertEquals(
            self::EXPECTED_URL,
            FakeNetwork::url([
                'uri'         => Constants::TEST_URL,
                'name'        => Constants::TEST_TITLE,
                'description' => Constants::TEST_DESCRIPTION
            ])
        );
    }

    public function testElementGeneration(): void
    {
        $expected = sprintf(
            '<a href="%s" class="%s" rel="noopener noreferrer">%s</a>',
            self::EXPECTED_URL,
            Constants::TEST_CLASS,
            Constants::TEST_LINK_CONTENT
        );
        $this->assertEquals(
            $expected,
            FakeNetwork::link([
                Constants::TEST_URL,
                Constants::TEST_TITLE,
                Constants::TEST_DESCRIPTION
            ], Constants::TEST_LINK_CONTENT, ['class' => Constants::TEST_CLASS])
        );
        $this->assertEquals(
            $expected,
            FakeNetwork::link([
                Constants::TEST_URL,
                Constants::TEST_TITLE,
                Constants::TEST_DESCRIPTION
            ], Constants::TEST_LINK_CONTENT, ['class' => Constants::TEST_CLASS_ARRAY])
        );
    }

    public function testFailOnInvalidArgumentName(): void
    {
        $this->assertEmpty(
            FakeNetwork::getAuthoritativeArgumentName('fake', ['real' => 'real'])
        );
    }
}