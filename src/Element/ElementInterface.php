<?php

namespace Plinct\Web\Element;

interface ElementInterface
{
    /**
     * @param $content
     * @return ElementInterface
     */
    public function content($content): ElementInterface;

    /**
     * @param array|null $attributes
     * @return ElementInterface
     */
    public function attributes(array $attributes = null): ElementInterface;

    /**
     * @param $name
     * @param $value
     * @return ElementInterface
     */
    public function setAttribute($name, $value): ElementInterface;

    /**
     * @param string $href
     * @return ElementInterface
     */
    public function href(string $href): ElementInterface;

    /**
     * @return array
     */
    public function ready(): array;
}
