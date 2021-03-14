<?php

namespace Bermuda\Utils;

/**
 * Class Date
 * @package Bermuda\Utils
 */
final class Date
{
    /**
     * @param \DateTimeInterface|null $date
     * @return \DateTimeImmutable
     */
    public static function firstDayOfWeek(\DateTimeInterface $date = null): \DateTimeImmutable
    {
        $date = $date != null ? clone $date : new \DateTimeImmutable();
        return $date->setISODate((int) $date->format('o'), (int) $date->format('W'), 1);
    }

    /**
     * @param $date
     * @return \DateTime
     */
    public static function lastDayOfWeek(\DateTimeInterface $date = null): \DateTimeImmutable
    {
        return self::firstDayOfWeek($date)->modify('+6 days');
    }

    /**
     * @param string $var
     * @return bool
     */
    public static function isDate(string $var): bool
    {
        try {
            new \DateTime($var);
            return true;
        }

        catch (\Throwable $e)
        {
            return false;
        }
    }
}
