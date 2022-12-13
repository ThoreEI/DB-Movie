<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3aeef0c016974e16671da75af0bb9df5
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3aeef0c016974e16671da75af0bb9df5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3aeef0c016974e16671da75af0bb9df5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3aeef0c016974e16671da75af0bb9df5::$classMap;

        }, null, ClassLoader::class);
    }
}