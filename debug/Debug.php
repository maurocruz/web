<?php

declare(strict_types=1);

namespace Plinct\Web\Debug;

use ReflectionException;

class Debug extends Switcher implements DebugInterface
{
    /**
     * @throws ReflectionException
     */
    public static function dump($var, int $maxDeep = 3)
    {
        self::$maxDeep = $maxDeep;

        // BACKTRACE
        $backtrace = debug_backtrace();
        $file = $backtrace[0]['file'];
        $line = $backtrace[0]['line'];

        $response = "$file on line $line:<br>";

        $response .= parent::switchVar($var);

        // RESPONSE
        echo "<pre style='font-size: 14px; background-color: #333; overflow: auto; color: #e7e7e7;'>$response</pre>";
    }

    static function var_dump($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
}