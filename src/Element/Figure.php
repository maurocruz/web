<?php

declare(strict_types=1);

namespace Plinct\Web\Element;

class Figure extends Element
{
    /**
     * @param array|null $attributes
     */
    public function __construct(array $attributes = null)
    {
        parent::__construct('figure', $attributes);
        parent::withObject();
    }

    /**
     * @param array|null $attributes
     * @return $this
     */
    public function attributes(array $attributes = null): Figure
    {
        parent::attributes($attributes);
        return $this;
    }

    /**
     * @param string $src
     * @return $this
     */
    public function src(string $src): Figure
    {
        $this->element['src'] = $src;
        return $this;
    }

    /**
     * @param $width
     * @return $this
     */
    public function width($width): Figure {
        $this->element['width'] = $width;
        return $this;
    }

    /**
     * @param $height
     * @return $this
     */
    public function height($height): Figure {
        $this->element['height'] = $height;
        return $this;
    }

    /**
     * @param string $caption
     * @return $this
     */
    public function caption(string $caption): Figure {
        $this->element['caption'] = $caption;
        return $this;
    }

    /**
     * @param array $imgAttributes
     * @return $this
     */
    public function imgAttributes(array $imgAttributes): Figure {
        $this->element['imgAttributes'] = $imgAttributes;
        return $this;
    }

    /**
     * @param array $figcaptionAttributes
     * @return $this
     */
    public function figcaptionAttributes(array $figcaptionAttributes): Figure {
        $this->element['figcaptionAttributes'] = $figcaptionAttributes;
        return $this;
    }
}
