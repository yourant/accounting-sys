<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita813a38919694b1658be361e19c53e52
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInita813a38919694b1658be361e19c53e52::$classMap;

        }, null, ClassLoader::class);
    }
}