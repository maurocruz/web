<?php

declare(strict_types=1);

namespace Plinct\Web\Element;

use Plinct\Web\Debug\Debug;
use Plinct\Web\Element\Form\Form;

class ElementFactory
{
    /**
     * @param string $tag
     * @param array|null $attributes
     * @param $content
     * @return Element
     */
    public static function element(string $tag, array $attributes = null, $content = null): Element
    {
        return new Element($tag, $attributes, $content);
    }

    /**
     * @param array|null $attributes
     * @return Figure
     */
    public static function figure(array $attributes = null): Figure
    {
        return new Figure($attributes);
    }

    /**
     * @param array|null $attributes
     * @return Form
     */
    public static function form(array $attributes = null): Form
    {
        return new Form($attributes);
    }

    /**
     * @param array|null $attributes
     * @return Picture
     */
    public static function picture(array $attributes = null): Picture
    {
        return new Picture($attributes);
    }

    /**
     * @param array|null $attributes
     * @return ListElement
     */
    public static function list(array $attributes = null): ListElement
    {
        return new ListElement($attributes);
    }
}
