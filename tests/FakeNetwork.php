<?php


namespace AlwaysBlank\Extrovert\Tests;


use AlwaysBlank\Extrovert\Network;

class FakeNetwork extends Network
{
    public const BASE                 = 'http://test.com/?';

    public static function constructUrl($args): string
    {
        return self::BASE . http_build_query($args);
    }
}