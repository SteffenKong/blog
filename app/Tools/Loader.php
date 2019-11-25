<?php
namespace App\Tools;

/**
 * Class Loader
 * @package App\Tools
 * 单例工具
 */
class Loader {
    public static function singleton($className) {
        $classList = [];
        if(!isset($classList[$className])) {
            $classList[$className] = new $className;
        }
        return $classList[$className];
    }
}
