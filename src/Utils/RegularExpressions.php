<?php

namespace App\Utils;

class RegularExpressions
{
    /**
     * @return string
     */
    public static function http(): string
    {
        return '/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/';
    }

    /**
     * @return string
     */
    public static function filePath(): string
    {
        return '/^[a-z0-9.\/_-]+$/';
    }

    /**
     * @return string
     */
    public static function accessLog(): string
    {
        return '/[0-9.\s-]+\[.+\]\s\"([A-Z]{3,6}\s(?<url>[^\"]+)\s[^\"]+|-)\"\s(?<status>[0-9]+)\s(?<size>[0-9]+)\s\"[^\"]+\"\s\"(?<client>.+)\"/';
    }

    /**
     * @return string
     */
    public static function googleBot(): string
    {
        return '/Googlebot/';
    }

    /**
     * @return string
     */
    public static function baiduBot(): string
    {
        return '/Baidu/';
    }

    /**
     * @return string
     */
    public static function bingBot(): string
    {
        return '/[bB]ing/';
    }

    /**
     * @return string
     */
    public static function yandexBot(): string
    {
        return '/YandexBot/';
    }
}
