<?php

declare(strict_types=1);

namespace Plinct\Web\Debug;

use ReflectionException;

class ArrayPrint
{
    /**
     * @param $var
     * @return string
     * @throws ReflectionException
     */
    public static function printArray($var): ?string
    {
        if(Debug::$currentDeep < Debug::$maxDeep) {
            Debug::$currentDeep++;

            $response = Debug::spanClosure(gettype($var)) . " [<ul style='margin: 0; list-style: none; padding-left: 1em;'>";
            foreach ($var as $key => $value) {

                $keyResult = is_string($key) ? "'$key'" : "[$key]";

                if (is_array($value) || is_object($value)) {
                    $valueResult = Debug::switchVar($value);
                } elseif (is_string($value)) {
                    $valueResult = "\"$value\"";
                } else {
                    $valueResult = $value;
                }

                $response .= "<li>$keyResult => $valueResult</li>";
            }
            $response .= "</ul>],";

            Debug::$currentDeep = 0;

        } else {
            $response = Debug::spanClosure(gettype($var)) . " [...]";
        }

        return  $response;
    }
}