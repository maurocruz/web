<?php

declare(strict_types=1);

namespace Plinct\Web\Element;

class ElementFactory
{
    public static function picture(): Picture
    {
        return new Picture();
    }
}
