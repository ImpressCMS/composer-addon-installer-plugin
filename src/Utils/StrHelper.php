<?php

namespace ImpressCMS\Composer\AddonInstaller\Utils;

/**
 * Few string malipulation related functions
 *
 * @package ImpressCMS\Composer\AddonInstaller\Utils
 */
final class StrHelper
{

    /**
     * StrHelper disabled constructor.
     */
    private function __construct()
    {
    }

    /**
     * Checks if string starts with another string
     *
     * @param string $str String where to look
     * @param string $needle String to look for
     *
     * @return bool
     */
    public static function str_starts_with(string $str, string $needle): bool
    {
        return strpos($str, $needle) === 0;
    }

    /**
     * Checks if string ends with such string
     *
     * @param string $str Where to look
     * @param string $needle What to look
     *
     * @return bool
     */
    public static function str_ends_with(string $str, string $needle): bool
    {
        return substr($str, -strlen($needle)) === $needle;
    }


}