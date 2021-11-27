<?php

declare(strict_types=1);

namespace Plinct\Web\Element;

use Plinct\Web\Element\Form\Form;

class ElementFactory
{
    public static function element(string $tag, array $attributes = null, $content = null): Element
    {
        return new Element($tag, $attributes, $content);
    }

    public static function form(array $attributes = null): Form
    {
        return new Form($attributes);
    }

    public static function picture(): Picture
    {
        return new Picture();
    }
}
