<?php


namespace AlwaysBlank\Extrovert;


abstract class Network
{
    /**
     * Returns a URL to share on the service, with arguments included.
     *
     * ** NOT ALL NETWORKS SUPPORT ALL ARGUMENTS **
     *
     * Calling ::url() on a network that does not support optional arguments will not fail; the result
     * simply won't include those arguments.
     *
     * This method can accept arguments in several different ways:
     * - as a series of single arguments in the order of uri, title (optional), message (optional)
     * - an array of items in the same order
     * - a keyed array of items in any order (see Constants::SHARE_ARGS for possible keys)
     *
     * @param array $args
     *
     * @return string
     */
    abstract public static function constructUrl($args): string;

    public static function url(...$args): string
    {
        return static::constructUrl(static::parseUrlArgs($args));
    }

    /**
     * Parse the arguments passed to ::url().
     *
     * @param array $args
     *
     * @return array
     */
    public static function parseUrlArgs(array $args): array
    {
        $extracted = array_reduce($args, function ($carry, $current) {
            if (is_array($current)) {
                return array_merge($carry, $current);
            }
            $carry[] = $current;

            return $carry;
        }, []);

        return static::ensureShareArgsFormat(static::checkShareArgs($extracted));
    }

    /**
     * Build a full link element.
     *
     * @param array  $share_args
     * @param string $content
     * @param array  $el_args
     *
     * @return string
     */
    public static function link(array $share_args, string $content, array $el_args = []): string
    {
        return sprintf(static::element($el_args), static::url(...$share_args), $content);
    }

    /**
     * Returns a string for use in sprintf or similar function.
     *
     * First argument for sprintf is the uri, second is the link content.
     *
     * @param array $el_args
     *
     * @return string
     */
    public static function element(array $el_args): string
    {
        $parts = [];
        foreach ($el_args as $type => $value) {
            switch (static::getAuthoritativeArgumentNameElement($type)) {
                case 'class':
                    if (is_string($value) || is_array($value)) {
                        $parts[] = sprintf(
                            'class="%s"',
                            is_array($value) ? join(' ', $value) : $value
                        );
                    }
                    break;
            }
        }
        $compiled_parts = join(' ', $parts);

        return '<a href="%1$s" ' . $compiled_parts . ' rel="noopener noreferrer">%2$s</a>';
    }

    /**
     * Returns an array containing all valid arguments.
     *
     * Returns an empty array on failure, or if no arguments seem valid.
     *
     * @param array $args
     *
     * @return array
     */
    public static function checkShareArgs(array $args): array
    {
        // You can pass an ordered or keyed array; this determines which type in a somewhat naive way
        $array_type = isset($args[0]) ? 'num' : 'key';
        switch ($array_type) {
            case 'key':
                $parsed = [];
                foreach ($args as $key => $value) {
                    if ('' !== static::getAuthoritativeArgumentNameShare($key)) {
                        $parsed[static::getAuthoritativeArgumentNameShare($key)] = $value;
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

    /**
     * This assures args are in the correct keyed format.
     *
     * You should run this on the results of ::checkShareArgs().
     *
     * If the array is already keyed, then we assume the keys are correct.
     *
     * @param array $args
     *
     * @return array
     */
    public static function ensureShareArgsFormat(array $args): array
    {
        if ( ! isset($args[0])) {
            return $args; // already keyed; we assume correctly
        }

        $keyed = [];
        foreach ($args as $num => $arg) {
            switch ($num) {
                case 0:
                    $keyed['uri'] = $arg;
                    break;
                case 1:
                    $keyed['name'] = $arg;
                    break;
                case 2:
                    $keyed['description'] = $arg;
                    break;
            }
        }

        return $keyed;
    }

    /**
     * Get the authoritative argument name based on a passed map.
     *
     * This is useful to allow arguments to be passed with different names.
     *
     * @param string $arg
     * @param array  $map
     *
     * @return string
     */
    public static function getAuthoritativeArgumentName(string $arg, array $map): string
    {
        if ( ! isset($map[$arg])) {
            return '';
        }

        return $map[$arg];
    }

    /**
     * Get the authoritative argument name for a share argument.
     *
     * @param string $arg
     *
     * @return string
     */
    public static function getAuthoritativeArgumentNameShare(string $arg): string
    {
        return static::getAuthoritativeArgumentName($arg, Constants::SHARE_ARGS);
    }

    /**
     * Get the authoritative argument name for an element argument.
     *
     * @param string $arg
     *
     * @return string
     */
    public static function getAuthoritativeArgumentNameElement(string $arg): string
    {
        return static::getAuthoritativeArgumentName($arg, Constants::ELEMENT_ARGS);
    }

    /**
     * Builds a query that is *not* urlencoded. Mostly useful for mailto: links.
     *
     * @param array $query
     *
     * @return string
     */
    public static function buildUnencodedQuery(array $query): string
    {
        $pairs = [];
        foreach ($query as $key => $item) {
            $pairs[] = "$key=$item";
        }
        return join('&', $pairs);
    }
}