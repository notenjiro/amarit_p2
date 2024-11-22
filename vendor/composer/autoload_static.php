<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit199c32e8d5d9115fb51b91513465603d
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Picqer\\Barcode\\' => 15,
        ),
        'I' => 
        array (
            'Intervention\\Image\\' => 19,
            'Intervention\\Gif\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Picqer\\Barcode\\' => 
        array (
            0 => __DIR__ . '/..' . '/picqer/php-barcode-generator/src',
        ),
        'Intervention\\Image\\' => 
        array (
            0 => __DIR__ . '/..' . '/intervention/image/src',
        ),
        'Intervention\\Gif\\' => 
        array (
            0 => __DIR__ . '/..' . '/intervention/gif/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit199c32e8d5d9115fb51b91513465603d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit199c32e8d5d9115fb51b91513465603d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit199c32e8d5d9115fb51b91513465603d::$classMap;

        }, null, ClassLoader::class);
    }
}