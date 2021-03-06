<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit505ab6c567efd6f22ef3d4f708ab794a
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'C' => 
        array (
            'Core\\' => 5,
            'Controllers\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Models',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Core',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Controllers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit505ab6c567efd6f22ef3d4f708ab794a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit505ab6c567efd6f22ef3d4f708ab794a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
