<?php
namespace Plinct\Web\Element;

class Figure extends Element {

    public function __construct(array $attributes = null) {
        parent::__construct('figure', $attributes);
        parent::withObject();
    }

    public function src(string $src): Figure {
        $this->element['src'] = $src;
        return $this;
    }

    public function width($width): Figure {
        $this->element['width'] = $width;
        return $this;
    }

    public function height($height): Figure {
        $this->element['height'] = $height;
        return $this;
    }

    public function caption(string $caption): Figure {
        $this->element['caption'] = $caption;
        return $this;
    }

    public function imgAttributes(array $imgAttributes): Figure {
        $this->element['imgAttributes'] = $imgAttributes;
        return $this;
    }

    public function figcaptionAttributes(array $figcaptionAttributes): Figure {
        $this->element['figcaptionAttributes'] = $figcaptionAttributes;
        return $this;
    }
}