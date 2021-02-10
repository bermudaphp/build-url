<?php

namespace Bermuda\Utils;

/**
 * Class URL
 * @package Bermuda\Utils
 */
final class URL
{
    public const schema = 'schema';
    public const user = 'user';
    public const pass = 'pass';
    public const host = 'host';
    public const port = 'port';
    public const path = 'path';
    public const anchor = 'anchor';
    
    public function __construct()
    {
        throw new \RuntimeException(__CLASS__ . ' is not instantiable');
    }

    /**
     * @param array $params
     * @return string
     */
    public static function build(array $params = []): string
    {
        $url = ($params[self::schema] ?? self::schema()) . '://';

        if (!empty($params[self::user]))
        {
            $url .= $params[self::user] . ':' . $params[self::pass] . '@';
        }

        $url .= ($params[self::host] ?? $_SERVER['HTTP_HOST']);

        if (!empty($params[self::port]))
        {
            $url .= ':' . $params[self::port];
        }

        $url .= '/';

        if (!empty($params[self::path]))
        {
            $url .= ltrim(is_string($params[self::path]) ? $params[self::path] : http_build_query((array) $params[self::path]), '/');
        }

        elseif (!empty($_SERVER['QUERY_STRING']))
        {
            $url .= '?' . $_SERVER['QUERY_STRING'];
        }

        if (!empty($params[self::anchor]))
        {
            $url .= '#' . $params[self::anchor];
        }

        return $url;
    }

    /**
     * @return string
     */
    private static function schema(): string
    {
        return $_SERVER['SERVER_PORT'] === '443'
        || !empty($_SERVER['HTTPS']) ? 'https' : 'http';
    }
}
