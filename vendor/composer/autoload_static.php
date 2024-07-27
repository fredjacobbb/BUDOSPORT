<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4e3da8fe515b5282f569ca8c20908d0f
{
    public static $files = array (
        'e408a977efcff868a334a05904a33d25' => __DIR__ . '/..' . '/leafs/session/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Leaf\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Leaf\\' => 
        array (
            0 => __DIR__ . '/..' . '/leafs/anchor/src',
            1 => __DIR__ . '/..' . '/leafs/session/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4e3da8fe515b5282f569ca8c20908d0f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4e3da8fe515b5282f569ca8c20908d0f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4e3da8fe515b5282f569ca8c20908d0f::$classMap;

        }, null, ClassLoader::class);
    }
}
