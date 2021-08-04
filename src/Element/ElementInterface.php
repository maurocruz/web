<?php

namespace Plinct\Web\Element;

interface ElementInterface {

    public function content($content): ElementInterface;

    public function attributes(array $attributes): ElementInterface;

    public function setAttribute($name, $value): ElementInterface;

    public function href(string $href): ElementInterface;

    public function ready(): array;
}