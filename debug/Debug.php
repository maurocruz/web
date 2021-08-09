<?php

declare(strict_types=1);

namespace Plinct\Web\Debug;

use ReflectionException;

class Debug implements DebugInterface
{
    /**
     * @var int
     */
    public static int $maxDeep;
    /**
     * @var int
     */
    public static int $currentDeep = 0;

    /**
     * @param $var
     * @param int $maxDeep
     * @throws ReflectionException
     */
    public static function dump($var, $maxDeep = 1)
    {
        self::$maxDeep = $maxDeep;

        // BACKTRACE
        $backtrace = debug_backtrace();
        $file = $backtrace[0]['file'];
        $line = $backtrace[0]['line'];

        $response = "$file on line $line:<br>";

        $response .= self::switchVar($var);

        // RESPONSE
        echo "<pre style='font-size: 14px; background-color: #333; overflow: auto; color: #e7e7e7;'>$response</pre>";
    }


    /**
     * @param $var
     * @return string
     * @throws ReflectionException
     */
    public static function switchVar($var): string
    {
        switch (gettype($var)) {
            case 'string':
                return Debug::spanClosure(gettype($var)) . " '$var'";
            case 'array':
                return ArrayPrint::printArray($var);
            case 'object':
                return PrintObject::printObject($var);
            case 'boolean':
                return $var === true ? 'true' : 'false';
            default:
                return " Undefined";
        }
    }


    /**
     * @param string $text
     * @param string $fontSize
     * @param string $color
     * @return string
     */
    public static function spanClosure(string $text, $fontSize = '0.85em;', $color = '#aaa;'): string {
        return "<span style='font-size: $fontSize; color: $color;'>$text</span>";
    }

}