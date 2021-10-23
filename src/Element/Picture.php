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

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * @param string $src
     */
    public function setSrc(string $src): void
    {
        $this->src = $src;
    }

    /**
     * @param $width
     * @param $height
     */
    public function setSource( $width, $height ): void
    {
        $this->source[] = ['width'=>$width,'height'=>$height];
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
