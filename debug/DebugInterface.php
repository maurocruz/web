<?php

declare(strict_types=1);

namespace Plinct\Web\Debug;

interface DebugInterface
{
    static function dump($var);

    static function var_dump($var);
}