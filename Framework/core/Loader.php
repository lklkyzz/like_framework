<?php
namespace Framework\core;
class Loader
{
    public static function loadClass()
    {

    }

    public static function loadCoreClass($class)
    {
        $classFile = ROOT_PATH. "{$class}.php";
        require_once $classFile;
    }
}