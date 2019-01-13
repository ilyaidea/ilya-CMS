<?php
namespace Lib\Enum;


abstract class BasicEnum
{
    private static $constCacheArray = NULL;

    public static function getConstants()
    {
        if (self::$constCacheArray == NULL)
        {
            self::$constCacheArray = [];
        }

        if (!array_key_exists(get_called_class(), self::$constCacheArray))
        {
            $reflect = new \ReflectionClass(get_called_class());
            self::$constCacheArray[get_called_class()] = $reflect->getConstants();
        }
        return self::$constCacheArray[get_called_class()];
    }

    public static function isValidName($name, $strict = false)
    {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value, $strict = true) {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict);
    }
}