<?php

namespace Bermuda\Utils;

final class URL
{
    public const schema = 'schema';
    public const user = 'user';
    public const pass = 'pass';
    public const host = 'host';
    public const port = 'port';
    public const path = 'path';
    public const params = 'params';
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

        if (!empty($params[self::user])) {
            $url .= $params[self::user] . ':' . $params[self::pass] . '@';
        }

        $url .= ($params[self::host] ?? $_SERVER['HTTP_HOST']);

        if (!empty($params[self::port])) {
            $url .= ':' . $params[self::port];
        }

        if (!empty($params[self::path])) {
            $url .= '/' . trim($params[self::path], '/');
        } elseif(!empty($_SERVER['REQUEST_URI'])) {
            $url .= '/' . trim((explode('?', $_SERVER['REQUEST_URI']))[0], '/');
        }

        if (!empty($params[self::params])) {
            $url .= '?'. http_build_query($params[self::params]);
        } elseif(count($_GET) > 1) {
            $queryParams = $_GET;
            array_shift($queryParams);

            $url .= '?'. http_build_query($queryParams);
        }

        if (!empty($params[self::anchor])) {
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
