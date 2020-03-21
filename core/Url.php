<?php

class Url
{
    private static function getProtocole()
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            return 'https://';
        } else {
            return 'http://';
        }
    }

    public static function getRequestUrl()
    {
        return self::getProtocole() . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }


    public static function getBaseUrl()
    {
        return self::getProtocole() . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    }

    public static function getRouterUrl()
    {
        $uri = str_replace(self::getBaseUrl(), '', self::getRequestUrl());
        $uri = ltrim($uri, '/');
        $uri = rtrim($uri, '/');
        return $uri;
    }


    // TODO : methode redondante
    public static function getFirstRouterUrl()
    {
        $detect_slash = strstr(self::getRouterUrl(), '/');
        $detect_param = strstr(self::getRouterUrl(), '?');

        if ($detect_slash) {
            if ($detect_param) {
                $firstOcurrence = strstr(self::getRouterUrl(), '/', true);
                //$firstOcurrence = strstr( $firstOcurrence , '?', true);
                return $firstOcurrence;
            } else {
                $firstOcurrence = strstr(self::getRouterUrl(), '/', true);
                return $firstOcurrence;
            }
        } else {
            if ($detect_param) {
                $Delet_param = strstr(self::getRouterUrl(), '?', true);
                return $Delet_param;
            } else {
                return self::getRouterUrl();
            }
        }
    }

    public static function getLastRouterUrl()
    {
        $detect_slash = strstr(self::getRouterUrl(), '/');
        $detect_param = strstr(self::getRouterUrl(), '?');

        if ($detect_slash) {
            if ($detect_param) {
                $lastOcurrence = substr(strrchr(self::getRouterUrl(), '/'), 1);
                $lastOcurrence = strstr($lastOcurrence, '?', true);
                return $lastOcurrence;
            } else {
                $lastOcurrence = substr(strrchr(self::getRouterUrl(), '/'), 1);
                return $lastOcurrence;
            }

        } else {
            if ($detect_param) {
                $Delet_param = strstr(self::getRouterUrl(), '?', true);
                return $Delet_param;
            } else {
                return self::getRouterUrl();
            }
        }
    }
}