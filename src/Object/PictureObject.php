<?php

declare(strict_types=1);

namespace Plinct\Web\Object;

use Exception;
use Plinct\Tool\Image\Image;
use Plinct\Web\Element\Element;

class PictureObject
{
    /**
     * @throws Exception
     */
    public function __invoke($value): array
    {
        unset($value['object']);
        $src = $value['src'] ?? null;
        $attributes = $value['attributes'] ?? null;
        $sources = $value['sources'] ?? $value['sourceMeasures'] ?? null;

        // PICTURE
        $picture = new Element('picture',$attributes);

            // SOURCES
            if ($sources) {
                foreach ($sources as $valueSource) {
                    $image = new Image($src);
                    $newWidth = $valueSource['width'];
                    $newHeight = $valueSource['height'];
                    $source = new Element('source');
                    $image->thumbnail($newWidth, $newHeight);
                    $source->attributes(['media'=>"(max-width: {$newWidth}px)",'srcset'=>$image->getThumbSrc()]);
                    $picture->content($source->ready());
                }
                $src = $image->getThumbSrc();
            } else {
                $image = new Image($src);
                $src = $image->getSrc();
            }

            // IMAGE
            $img = new Element('img');
            $img->attributes(['src'=>$src]);

        $picture->content($img->ready());

        // CONTENT
        if (isset($value['content'])) $picture->content($value['content']);

        // RESPONSE
        return $picture->ready();
    }
}
