<?php


namespace AlwaysBlank\Extrovert\Tests;


use AlwaysBlank\Extrovert\Network\Pinterest;
use PHPUnit\Framework\TestCase;

class PinterestTest extends TestCase
{
    public function testGetCorrectUrl(): void
    {
        $expected = 'http://pinterest.com/pin/create/button/?url=https%3A%2F%2Fwww.alwaysblank.org&media=https%3A%2F%2Fwww.alwaysblank.org%2Fmedia%2Fsite%2Ffosterarea.com%2Ffosterarea.com_front_page.png&description=This+library%2C+Extrovert%2C+can+make+building+websites+easier+by+taking+something+off+your+%F0%9F%8D%BD.';
        $this->assertEquals(
            $expected,
            Pinterest::url([
                'uri'   => Constants::TEST_URL,
                'image' => Constants::TEST_IMAGE_URL,
                'desc'  => Constants::TEST_DESCRIPTION,
                'title' => Constants::TEST_TITLE,
            ])
        );
    }
}
