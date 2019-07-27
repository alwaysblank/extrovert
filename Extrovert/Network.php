<?php


namespace AlwaysBlank\Extrovert;


abstract class Network
{
    /**
     * Returns a URL to share on the service, with arguments included.
     *
     * @param string      $uri
     * @param string|null $title
     * @param string|null $message
     *
     * @return string
     */
    abstract public static function url(string $uri, string $title = null, string $message = null): string;

    public static function link(array $share_args, array $el_args = []): string
    {
        $uri = static::url(...$share_args);
    }

    public static function checkShareArgs(array $args): array
    {
        $array_type = isset($args[0]) ? 'num' : 'key';
        switch ($array_type) {
            case 'key':
                $parsed = [];
                foreach ($args as $key => $value) {
                    if ('' !== static::getShareArgMap($key)) {
                        $parsed[static::getShareArgMap($key)] = $value;
                    }
                }

                return $parsed;
                break;
            default:
                return count($args) > 0 && count($args) <= 3
                    ? $args
                    : [];
                break;
        }
    }

    public static function getArgMap(string $arg, array $map): string
    {
        if ( ! isset($map[$arg])) {
            return '';
        }

        return $map[$arg];
    }

    public static function getShareArgMap($arg): string
    {
        return static::getArgMap($arg, Constants::SHARE_ARGS);
    }
}