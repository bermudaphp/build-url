<?php

namespace Bermuda\Utils;

/**
 * Class URL
 * @package Bermuda\Utils
 */
final class URL
{
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
        $url = ($params['schema'] ?? self::schema()) . '://';

        if (!empty($params['user']))
        {
            $url .= $params['user'] . ':' . $params['pass'] . '@';
        }

        $url .= ($params['host'] ?? $_SERVER['HTTP_HOST']);

        if (!empty($params['port']))
        {
            $url .= ':' . $params['port'];
        }

        $url .= '/';

        if (!empty($params['path']))
        {
            $url .= ltrim(is_string($params['path']) ? $params['path'] : http_build_query((array) $params['path']), '/');
        }

        elseif (!empty($_SERVER['QUERY_STRING']))
        {
            $url .= '?' . $_SERVER['QUERY_STRING'];
        }

        if (!empty($params['anchor']))
        {
            $url .= '#' . $params['anchor'];
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
