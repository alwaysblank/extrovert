<?php


namespace AlwaysBlank\Extrovert\Network;


use AlwaysBlank\Extrovert\Network;

class Facebook extends Network
{

    public const BASE         = 'https://www.facebook.com/sharer/sharer.php?';
    public const URI_TEMPLATE = 'u=%1$s';

    /**
     * Facebook supports only the URL argument.
     *
     * @param array $args
     *
     * @return string
     */
    public static function constructUrl($args): string
    {
        if ( ! isset($args['uri'])) {
            return ''; // invalid arguments
        }

        $template = static::BASE . static::URI_TEMPLATE;

        return sprintf($template, urlencode($args['uri']));
    }
}