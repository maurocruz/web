<?php
namespace Plinct\Web\Element;

class Image extends Element {

    public function __construct(array $attributes = null) {
        parent::__construct("img", $attributes);
        parent::withObject();
    }

    public function src(string $src): Image {
        $this->element['src'] = $src;
        return $this;
    }

    public function width($width): Image {
        $this->element['width'] = $width;
        return $this;
    }

    public function height($height): Image {
        $this->element['height'] = $height;
        return $this;
    }
}