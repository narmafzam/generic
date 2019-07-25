<?php

namespace Generic;

use Symfony\Component\Asset\UrlPackage;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;

class Asset
{
    public static function get($assetName, $homeDirectory = null, $staticDirectory = 's', $buildDirectory = 'b')
    {
        $package = new UrlPackage(
            Utility::getStaticUri(),
            new JsonManifestVersionStrategy(rtrim($homeDirectory, '/') . "/{$staticDirectory}/{$buildDirectory}/manifest.json"));
        $path = $buildDirectory . '/' . $assetName;
        return $package->getUrl($path);
    }
}