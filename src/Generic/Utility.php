<?php

namespace Generic;

class Utility
{
    public static function getStaticUri()
    {
        $url = false;
        if (defined('STATIC_URI')) {
            $url = STATIC_URI;
        } elseif (function_exists('get_site_url')) {
            $url = preg_replace('/^(?:https?:\/\/)?(?:www\.)?/', '$0s.', get_site_url());
        }
        return $url;
    }

    public static function getPathUrl($path)
    {
        $url = self::getStaticUri();
        if ($url) {
            $home = strrchr(dirname(dirname(__DIR__)), '/');
            $url = rtrim(rtrim($url, '/') . '/vendor' . $home, '/') . $path;
            return $url;
        }
        return null;
    }
}