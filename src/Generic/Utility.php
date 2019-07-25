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

    public static function getHomeDirectory()
    {
        $home = false;
        if (defined('ABSPATH')) {
            $home = ABSPATH;
        } elseif (isset($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['DOCUMENT_ROOT'])) {
            $home = str_replace(' ', '', $_SERVER['DOCUMENT_ROOT']);
            $home = rtrim($home, '/') . '/';
        } else {
            //TODO ... I don't know how get home path.
        }
        return $home;
    }
}