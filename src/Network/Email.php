<?php


namespace AlwaysBlank\Extrovert\Network;


use AlwaysBlank\Extrovert\Network;

class Email extends Network
{
    public const BASE = 'mailto:?';

    public static function constructUrl($args): string
    {
        // An email is very strange without a subject and body, so if they aren't set
        // then set some reasonable defaults.
        if ( ! isset($args['description'])) {
            $args['description'] = "Visit %s";
        }

        if ( ! $args['name']) {
            $args['name'] = "Suggested link";
        }

        $query = [];
        foreach ($args as $key => $value) {
            switch ($key) {
                case 'name':
                    $query['subject'] = $value;
                    break;
                case 'description':
                    $query['body'] = sprintf($value, $args['uri']);
                    break;
            }
        }

        return self::BASE . static::buildUnencodedQuery($query);
    }
}