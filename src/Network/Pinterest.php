<?php


namespace AlwaysBlank\Extrovert\Network;


use AlwaysBlank\Extrovert\Network;

class Pinterest extends Network
{
    public const BASE = 'http://pinterest.com/pin/create/button/?';

    public static function constructUrl($args): string
    {
        $query = [];
        foreach ($args as $key => $value) {
            switch ($key) {
                case 'uri':
                    $query['url'] = $value;
                    break;
                case 'media':
                    $query['media'] = $value;
                    break;
                case 'description':
                    $query['description'] = $value;
                    break;
            }
        }

        return static::BASE . http_build_query($query);
    }
}
