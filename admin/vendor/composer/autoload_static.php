<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcaf9fec01357fbb84b37dcd84996ed2a
{
    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Sastrawi\\' => 
            array (
                0 => __DIR__ . '/..' . '/sastrawi/sastrawi/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitcaf9fec01357fbb84b37dcd84996ed2a::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
