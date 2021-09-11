<?php

namespace Bermuda\Utils;

class Converter
{
    public static function bytesTo(int $bytes, int $precision = 2): string
    {
        return round(pow(1024, ($base = log($bytes, 1024)) - floor($base)), $precision) .' '. ['', 'KB', 'MB', 'GB', 'TB'][floor($base)];
    }
}
