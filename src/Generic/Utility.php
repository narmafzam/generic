<?php

namespace Generic;

class Utility
{
    const DIRNAME_COUNT = 2;

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

    public static function getAssetUrl($path, $homePath = null, $count = self::DIRNAME_COUNT)
    {
        $url = self::getStaticUri();
        if ($url) {
            $home = self::getHomeDirectoryName($homePath, $count);
            $url = rtrim(rtrim($url, '/') . '/vendor' . $home, '/') . $path;
            return $url;
        }
        return null;
    }

    public static function getHomeDirectoryName($path = null, $count = self::DIRNAME_COUNT)
    {
        return strrchr(self::getHomeDirectory($path, $count), '/');
    }

    public static function getHomeDirectory($path = null, $count = self::DIRNAME_COUNT)
    {
        $home = false;
        if ($path) {
            for ($i = 0; $i < $count; $i++) {
                $path = dirname($path);
            }
            return $path;
        } elseif (defined('ABSPATH')) {
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