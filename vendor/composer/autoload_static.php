<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit35ab6c1d2935633bcca00baac9f0581f
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit35ab6c1d2935633bcca00baac9f0581f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit35ab6c1d2935633bcca00baac9f0581f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
