<?php

declare(strict_types=1);

namespace Plinct\Web\Element;

use Exception;
use Plinct\Web\Object\PictureObject;

class Picture
{
    /**
     * @var ?array
     */
    private ?array $attributes = null;
    /**
     * @var string
     */
    private string $src;
    /**
     * @var ?array
     */
    private ?array $source = null;

    public function __construct(array $attributes = null)
    {
        $this->setAttributes($attributes);
    }

    /**
     * @param array $attributes
     * @return Picture
     */
    public function setAttributes(array $attributes): Picture
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @param string $src
     * @return Picture
     */
    public function setSrc(string $src): Picture
    {
        $this->src = $src;
        return $this;
    }

    /**
     * @param $width
     * @param $height
     * @return Picture
     */
    public function setSource( $width, $height ): Picture
    {
        $this->source[] = ['width'=>$width,'height'=>$height];
        return $this;
    }

    /**
     * @return array
     */
    public function ready(): array
    {
        $value['attributes'] = $this->attributes;
        $value['src'] = $this->src;
        $value['sources'] = $this->source;

        $pictureObject = new PictureObject;

        try {
            return $pictureObject($value);
        } catch (Exception $e) {
            return [$e];
        }
    }
}
