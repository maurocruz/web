<?php

namespace Plinct\Web\Debug;

use ReflectionException;

abstract class Switcher
{
    /**
     * @var int
     */
    protected static int $maxDeep;
    /**
     * @var int
     */
    protected static int $currentDeep = 0;

    /**
     * @param $var
     * @param int $maxDeep
     * @throws ReflectionException
     */

    use ArrayPrintTrait;
    use PrintObjectTrait;

    /**
     * @param $var
     * @return string
     * @throws ReflectionException
     */
    protected static function switchVar($var): string
    {
        switch (gettype($var)) {
            case 'array':
                return self::printArray($var);
            case 'object':
                return self::printObject($var);
            case 'boolean':
                return $var === true ? 'true' : 'false';
            default:
                return self::spanClosure(gettype($var)) . " '$var'";
        }
    }

    /**
     * @param string $text
     * @param string $fontSize
     * @param string $color
     * @return string
     */
    protected static function spanClosure(string $text, string $fontSize = '0.85em', string $color = '#aaa'): string {
        return "<span style='font-size: $fontSize; color: $color;'>$text</span>";
    }
}