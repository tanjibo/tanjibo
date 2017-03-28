<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit951c1b5b1902c8dfe842bdee239725dc
{
    public static $files = array (
        '841780ea2e1d6545ea3a253239d59c05' => __DIR__ . '/..' . '/qiniu/php-sdk/src/Qiniu/functions.php',
        '1442c3355bd01dbb8127850c20afbe9f' => __DIR__ . '/../..' . '/tan/helper.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tan\\' => 4,
        ),
        'Q' => 
        array (
            'Qiniu\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tan\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tan',
        ),
        'Qiniu\\' => 
        array (
            0 => __DIR__ . '/..' . '/qiniu/php-sdk/src/Qiniu',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit951c1b5b1902c8dfe842bdee239725dc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit951c1b5b1902c8dfe842bdee239725dc::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}