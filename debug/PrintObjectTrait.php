<?php

declare(strict_types=1);

namespace Plinct\Web\Debug;

use ReflectionException;
use ReflectionObject;

trait PrintObjectTrait
{

    /**
     * @param $object
     * @return string
     * @throws ReflectionException
     */
    protected static function printObject($object): string
    {
        $reflectionClass = new ReflectionObject($object);
        $nameClass = $reflectionClass->getName();

        $response = "<br>".self::spanClosure(gettype($object),'0.95em')." ".$nameClass;
        $response .= "() {<ul class='print-object' style='margin: 0; list-style: none; padding-left: 1em;'>";

        // PROPERTIES
        if (!empty($reflectionClass->getProperties())) {
            $response .= self::getProperties($object, $reflectionClass->getProperties());
        }

        // METHODS
        if (!empty($reflectionClass->getMethods())) {
            $response .= self::getMethods($reflectionClass->getMethods());
        }

        $response .= "</ul>}";

        Debug::$currentDeep = 0;

        return $response;
    }

    /**
     * @param $object
     * @param $reflectionProperties
     * @return string|null
     * @throws ReflectionException
     */
    private static function getProperties($object, $reflectionProperties): ?string
    {
        $response = null;
        foreach ($reflectionProperties as $reflectionProperty) {
            // visibility
            $visibility = self::getVisibility($reflectionProperty);
            // name
            $name = $reflectionProperty->getName();
            // value
            $reflectionProperty->setAccessible(true);
            $value = $reflectionProperty->getValue($object);

            $valueText = self::switchVar($value);

            // response
            $response .= "<li>$visibility $name = $valueText</li>";
        }
        return $response;
    }

    /**
     * @param $reflectionMethods
     * @return string|null
     */
    private static function getMethods($reflectionMethods): ?string
    {
        $response = null;

        foreach ($reflectionMethods as $reflectionMethod) {
            $params = [];
            // visibility
            $visibility = self::getVisibility($reflectionMethod);
            // name
            $name = $reflectionMethod->getName();
            // parameter
            $parameters = null;
            if (!empty($reflectionMethod->getParameters())) {
                foreach ($reflectionMethod->getParameters() as $valueParams) {
                    $params[] = $valueParams->getName();
                }
                $parameters = self::spanClosure(implode(", ", $params),'0.9em');
                unset($params);
            }
            // return
            $return = null;
            if($reflectionMethod->getReturnType()) {
                $return = ": " . self::spanClosure($reflectionMethod->getReturnType()->getName());
            }

            // response
            $response .= "<li>$visibility $name($parameters)$return;</li>";
        }

        return $response;
    }


    /**
     * @param $reflection
     * @return string
     */
    private static function getVisibility($reflection): string {
        $visibility = "<span style='font-size: 0.75em; color: #666;'>";
        $visibility .= $reflection->isPrivate()
            ? 'private'
            : ($reflection->isProtected()
                ? 'protected'
                : ($reflection->isPublic()
                    ? 'public'
                    : ($reflection->isStatic()
                        ? 'static'
                        : null
                    )
                )
            );
        $visibility .= "</span>";
        return $visibility;
    }
}