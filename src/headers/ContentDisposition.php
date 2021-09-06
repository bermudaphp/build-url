<?php

namespace Bermuda\Utils\Headers;

final class ContentDisposition
{
    public const inline = 'inline';
    public const attachment = 'attachment';
    public const formData = 'form-data';

    /**
     * @param string $filename
     * @return string
     */
    public static function attachment(string $filename): string
    {
        return self::attachment . '; filename="' . $filename .'"';
    }

    /**
     * @param string $fieldName
     * @param string $filename
     * @return string
     */
    public static function formData(string $fieldName, string $filename): string
    {
        return self::formData . '; name="'. $fieldName .'"; filename="' . $filename . '"';
    }
}
