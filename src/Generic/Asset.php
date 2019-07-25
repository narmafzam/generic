<?php

namespace Generic;

use mysql_xdevapi\Exception;
use Symfony\Component\Asset\UrlPackage;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;

class Asset
{
    public static function get($assetName, $homeDirectory = null, $staticDirectory = 's', $buildDirectory = 'b')
    {
        if (empty($homeDirectory)) {
            $homeDirectory = Utility::getHomeDirectory();
        }
        if ($homeDirectory) {
            $package = new UrlPackage(
                Utility::getStaticUri(),
                new JsonManifestVersionStrategy(rtrim($homeDirectory, '/') . "/{$staticDirectory}/{$buildDirectory}/manifest.json"));
            $path = $buildDirectory . '/' . $assetName;
            return $package->getUrl($path);
        } else {
            throw new Exception('cannot find home directory, place pass your home directory as argument.');
        }
    }
}