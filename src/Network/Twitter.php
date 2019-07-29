<?php


namespace AlwaysBlank\Extrovert\Network;


use AlwaysBlank\Extrovert\Network;

class Twitter extends Network
{
    public const BASE = 'https://twitter.com/share?';

    public static function constructUrl($args): string
    {
        $query = [];
        foreach ($args as $key => $value) {
            switch ($key) {
                case 'uri':
                    $query['url'] = $value;
                    break;
                case 'name':
                    $query['text'] = $value;
                    break;
            }
        }

        return static::BASE . http_build_query($query);
    }
}