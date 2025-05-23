<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4e128e4339b32f32684d8a88c8ca8e1a
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Daw2\\Hoja1\\' => 11,
        ),
        'B' => 
        array (
            'Brick\\Math\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Daw2\\Hoja1\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Brick\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/brick/math/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4e128e4339b32f32684d8a88c8ca8e1a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4e128e4339b32f32684d8a88c8ca8e1a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4e128e4339b32f32684d8a88c8ca8e1a::$classMap;

        }, null, ClassLoader::class);
    }
}
