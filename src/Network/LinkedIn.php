<?php


namespace AlwaysBlank\Extrovert\Network;


use AlwaysBlank\Extrovert\Network;

class LinkedIn extends Network
{

    public const BASE = 'https://www.linkedin.com/shareArticle?mini=true&';


    public static function constructUrl($args): string
    {
        $query = [];
        foreach ($args as $key => $value) {
            switch ($key) {
                case 'uri':
                    $query['url'] = $value;
                    break;
                case 'name':
                    $query['title'] = $value;
                    break;
                case 'description':
                    $query['summary'] = $value;
                    break;
            }
        }

        return static::BASE . http_build_query($query);
    }
}